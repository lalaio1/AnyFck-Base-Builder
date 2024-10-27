<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once './config/config.php';

class ConfigBuilderAPI {
    private $historyPath = '../history/history.json';
    private $defaultsPath = '../global/defaults.yml';
    private $configPath = '../scripts/config.conf';
    
    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        
        switch ($method) {
            case 'GET':
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'getDefaults':
                            return $this->getDefaults();
                        case 'getHistory':
                            return $this->getHistory();
                        default:
                            return $this->sendResponse(400, 'Invalid action');
                    }
                }
                break;
                
            case 'POST':
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'buildConfig':
                            $data = json_decode(file_get_contents('php://input'), true);
                            return $this->buildConfig($data);
                        default:
                            return $this->sendResponse(400, 'Invalid action');
                    }
                }
                break;
                
            default:
                return $this->sendResponse(405, 'Method not allowed');
        }
    }
    
    private function getDefaults() {
        try {
            if (!file_exists($this->defaultsPath)) {
                return $this->sendResponse(404, 'Defaults file not found');
            }
            
            $yaml = yaml_parse_file($this->defaultsPath);
            return $this->sendResponse(200, 'Success', $yaml);
        } catch (Exception $e) {
            return $this->sendResponse(500, 'Error reading defaults: ' . $e->getMessage());
        }
    }
    
    private function getHistory() {
        try {
            if (!file_exists($this->historyPath)) {
                return $this->sendResponse(200, 'Success', []);
            }
            
            $history = json_decode(file_get_contents($this->historyPath), true);
            return $this->sendResponse(200, 'Success', $history);
        } catch (Exception $e) {
            return $this->sendResponse(500, 'Error reading history: ' . $e->getMessage());
        }
    }
    
    private function buildConfig($data) {
        try {
            if (!$data || !is_array($data)) {
                return $this->sendResponse(400, 'Invalid configuration data');
            }
            
            // Create config file
            $configContent = '';
            foreach ($data as $key => $value) {
                $configContent .= "$key=$value\n";
            }
            
            // Ensure directory exists
            $configDir = dirname($this->configPath);
            if (!is_dir($configDir)) {
                mkdir($configDir, 0755, true);
            }
            
            // Write config file
            file_put_contents($this->configPath, $configContent);
            
            // Update history
            $history = [];
            if (file_exists($this->historyPath)) {
                $history = json_decode(file_get_contents($this->historyPath), true);
            }
            
            $nextId = count($history) + 1;
            $history[] = [
                'id' => $nextId,
                'config' => $data,
                'timestamp' => date('Y-m-d H:i:s')
            ];
            
            // Ensure history directory exists
            $historyDir = dirname($this->historyPath);
            if (!is_dir($historyDir)) {
                mkdir($historyDir, 0755, true);
            }
            
            file_put_contents($this->historyPath, json_encode($history, JSON_PRETTY_PRINT));
            
            return $this->sendResponse(200, 'Configuration built successfully', [
                'configPath' => $this->configPath,
                'historyId' => $nextId
            ]);
            
        } catch (Exception $e) {
            return $this->sendResponse(500, 'Error building configuration: ' . $e->getMessage());
        }
    }
    
    private function sendResponse($status, $message, $data = null) {
        http_response_code($status);
        return json_encode([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}

// Initialize and handle the request
$api = new ConfigBuilderAPI();
echo $api->handleRequest();