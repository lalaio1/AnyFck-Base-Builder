from imports.imports import *

def create_config_file():
    os.system('cls' if os.name == 'nt' else 'clear')
    print_banner()

    defaults_path = './global/defaults.yml'
    defaults = load_defaults_from_yaml(defaults_path)
    
    print_section("[i] Configuração BUILDER")
    Write.Print("\n[*] Pressione ENTER para usar os valores padrão ou digite um novo valor\n", 
                Colors.blue_to_cyan, interval=0.001)
    
    config = {}
    for key, data in defaults.items():
        config[key] = get_input_with_default(
            key,
            data["value"],
            data["desc"]
        )
    
    config_path = Path("./scripts/config.conf")
    config_path.parent.mkdir(parents=True, exist_ok=True)
    
    # Caminho do arquivo de histórico
    history_path = Path("./history/history.json")
    history, next_id = load_history(history_path)
    
    try:
        with open(config_path, "w") as f:
            for key, value in config.items():
                f.write(f"{key}={value}\n")
        
        print_section("[+] Configuração Concluída")
        Write.Print(f"""
[√] Arquivo de configuração criado com sucesso!
[PATH] {config_path.absolute()}
[i] Resumo das configurações:
""", Colors.blue_to_cyan, interval=0.001)

        for key, value in config.items():
            Write.Print(f"[•] {key}: {value}\n", 
                       Colors.blue_to_purple, interval=0.001)

        # Adiciona a nova configuração ao histórico
        history.append({"id": next_id, "config": config})
        save_history(history_path, history)  # Salva o histórico atualizado

    except Exception as e:
        Write.Print(f"\n[!] ERRO: Não foi possível criar o arquivo de configuração:\n{str(e)}\n", 
                    Colors.blue_to_purple, interval=0.001)