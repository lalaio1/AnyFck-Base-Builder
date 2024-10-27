from pystyle import Colors, Write

def print_section(text):
    Write.Print(f"\n{text}\n{'─' * 50}\n", Colors.blue_to_purple, interval=0.001)