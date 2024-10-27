# -== imports
from imports.imports import * 



def save_history(history_path, history):
    with open(history_path, "w") as f:
        json.dump(history, f, indent=4)