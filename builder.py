# -==== Import main func
from func.create_config_file import create_config_file

# -==== import 
from imports.imports import *



# -=== Config o logger
log_file_path = './logs/logs.log'
os.makedirs(os.path.dirname(log_file_path), exist_ok=True)

logging.basicConfig(
    filename=log_file_path,
    level=logging.INFO,  
    format='%(asctime)s - %(levelname)s - %(message)s',  
)

# -=========================== MAIN
if __name__ == "__main__":
    try:
        logging.info("Iniciando o processo de configuração.")
        create_config_file()
        logging.info("Configuração concluída com sucesso.")
    except KeyboardInterrupt:
        logging.warning("Processo interrompido pelo usuário.")
        Write.Print("\n\n[!] Processo interrompido pelo usuário.\n", 
                   Colors.blue_to_purple, interval=0.001)
    except Exception as e:
        logging.error(f"Ocorreu um erro: {e}")
        Write.Print(f"\n[!] ERRO: {e}\n", 
                    Colors.blue_to_purple, interval=0.001)