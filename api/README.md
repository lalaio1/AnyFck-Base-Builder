# Configuration Builder API Documentation

## Overview
The Configuration Builder API provides endpoints to manage and create configuration files for the AnyDesk installation and setup process. This RESTful API allows you to retrieve default settings, access build history, and generate new configuration files.

## Base URL
```
http://your-server/api.php
```

## Authentication
Currently, the API is open and does not require authentication. For production use, it's recommended to implement appropriate authentication mechanisms.

## API Endpoints

### 1. Get Default Configuration
Retrieves the default configuration values from the YAML file.

**Request**
```http
GET /api.php?action=getDefaults
```

**Response**
```json
{
  "status": 200,
  "message": "Success",
  "data": {
    "anydeskURL": {
      "value": "http://download.anydesk.com/AnyDesk.exe",
      "desc": "[i] URL para download do executável do AnyDesk"
    },
    "installPath": {
      "value": "C:\\ProgramData\\AnyDesk",
      "desc": "[i] Diretório onde o AnyDesk será instalado"
    },
    // ... other default values
  }
}
```

### 2. Get Build History
Retrieves the history of all previously built configurations.

**Request**
```http
GET /api.php?action=getHistory
```

**Response**
```json
{
  "status": 200,
  "message": "Success",
  "data": [
    {
      "id": 1,
      "config": {
        "anydeskURL": "http://download.anydesk.com/AnyDesk.exe",
        "installPath": "C:\\ProgramData\\AnyDesk",
        // ... other configuration values
      },
      "timestamp": "2024-10-27 14:30:00"
    }
    // ... other history entries
  ]
}
```

### 3. Build New Configuration
Creates a new configuration file based on provided parameters.

**Request**
```http
POST /api.php?action=buildConfig
Content-Type: application/json

{
  "anydeskURL": "http://download.anydesk.com/AnyDesk.exe",
  "installPath": "C:\\ProgramData\\AnyDesk",
  "password": "yourpassword",
  "adminUsername": "administrator",
  "adminPassword": "adminpass",
  "webhookURL": "YOUR_DISCORD_WEBHOOK_URL"
}
```

**Response**
```json
{
  "status": 200,
  "message": "Configuration built successfully",
  "data": {
    "configPath": "../scripts/config.conf",
    "historyId": 2
  }
}
```

## Error Handling

The API uses standard HTTP status codes and returns error messages in a consistent format:

```json
{
  "status": 400,
  "message": "Error message here",
  "data": null
}
```

### Common Status Codes
- 200: Success
- 400: Bad Request
- 404: Not Found
- 405: Method Not Allowed
- 500: Internal Server Error

## File Formats

### Configuration File Format
The generated configuration file follows this format:
```
key1=value1
key2=value2
key3=value3
```

### History File Format
The history is stored in JSON format:
```json
[
  {
    "id": 1,
    "config": {
      // configuration key-value pairs
    },
    "timestamp": "YYYY-MM-DD HH:MM:SS"
  }
]
```

## Implementation Requirements

### Server Requirements
- PHP 7.4 or higher
- YAML extension installed
- Write permissions for the following directories:
  - `../scripts/` (for config files)
  - `../history/` (for history files)
  - `../logs/` (for log files)

### Required Extensions
- php-yaml
- php-json

## Installation

1. Clone the repository or download the API files
2. Create the required directories:
```bash
mkdir -p ../scripts ../history ../logs
chmod 755 ../scripts ../history ../logs
```

3. Configure the settings in `config.php`:
```php
define('DEBUG_MODE', false);
define('LOG_PATH', '../logs/api.log');
// ... other configurations
```

4. Ensure proper file permissions:
```bash
chmod 644 api.php config.php
```

## Examples

### Using cURL

1. Get Defaults:
```bash
curl -X GET "http://your-server/api.php?action=getDefaults"
```

2. Get History:
```bash
curl -X GET "http://your-server/api.php?action=getHistory"
```

3. Build Configuration:
```bash
curl -X POST "http://your-server/api.php?action=buildConfig" \
  -H "Content-Type: application/json" \
  -d '{
    "anydeskURL": "http://download.anydesk.com/AnyDesk.exe",
    "installPath": "C:\\ProgramData\\AnyDesk",
    "password": "mypassword",
    "adminUsername": "admin",
    "adminPassword": "adminpass",
    "webhookURL": "https://discord.webhook.url"
  }'
```

### Using JavaScript Fetch

```javascript
// Get Defaults
fetch('http://your-server/api.php?action=getDefaults')
  .then(response => response.json())
  .then(data => console.log(data));

// Build Configuration
fetch('http://your-server/api.php?action=buildConfig', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    anydeskURL: "http://download.anydesk.com/AnyDesk.exe",
    installPath: "C:\\ProgramData\\AnyDesk",
    password: "mypassword",
    adminUsername: "admin",
    adminPassword: "adminpass",
    webhookURL: "https://discord.webhook.url"
  })
})
.then(response => response.json())
.then(data => console.log(data));
```

## Security Considerations

1. **Input Validation**: All input parameters are validated before processing.
2. **File Paths**: The API uses predefined paths to prevent directory traversal attacks.
3. **Error Handling**: Detailed error messages are logged but not exposed in production.
4. **CORS**: Cross-Origin Resource Sharing is configured but should be restricted in production.

## Best Practices

1. Always check the response status code
2. Implement proper error handling in your client code
3. Regularly backup the history file
4. Monitor the log files for errors
5. Implement authentication for production use
6. Use HTTPS in production

## Support

For issues, bugs, or feature requests, please contact the development team or create an issue in the repository.

## Version History

- 1.0.0 (2024-10-27)
  - Initial release
  - Basic CRUD operations
  - History tracking
  - YAML configuration support
