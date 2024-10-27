from pystyle import Colors, Write

def get_input_with_default(prompt, default_value, description=""):
    if description:
        Write.Print(f"\n{description}\n", Colors.blue_to_cyan, interval=0.001)
    
    user_input = Write.Input(f"[?] {prompt} \n[Default → {default_value}]\n> ", 
                            Colors.blue_to_cyan, interval=0.001).strip()
    
    if not user_input:
        Write.Print(f"[+] Usando valor padrão: {default_value}\n", 
                   Colors.blue_to_cyan, interval=0.001)
    else:
        Write.Print(f"[+] Valor definido: {user_input}\n", 
                   Colors.blue_to_cyan, interval=0.001)
    
    return user_input if user_input else default_value