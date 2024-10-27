from pystyle import Colors, Write, Center

def print_banner():
    banner = r"""
   _____                ___________             __    
  /  *  \   *___ ___.__.\_   _____/_ **   **__ |  | __
 /  /_\  \ /    <   |  | |    __)|  |  \_/ ___\|  |/ /
/    |    \   |  \___  | |     \ |  |  /\  \___|    <
\____|__  /___|  / ____| \___  / |____/  \___  >__|_ \
        \/     \/\/          \/              \/     \/
    """
    Write.Print(Center.XCenter(banner), Colors.blue_to_purple, interval=0.001)