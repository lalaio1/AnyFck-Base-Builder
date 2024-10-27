# -==== imports
import os 
import json


# -===== Load history json
def load_history(history_path):
    if not os.path.exists(history_path):
        return [], 0 
    
    with open(history_path, "r") as f:
        history = json.load(f)
    
    return history, len(history) + 1