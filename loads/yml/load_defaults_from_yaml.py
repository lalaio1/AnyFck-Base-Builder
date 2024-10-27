import yaml

def load_defaults_from_yaml(yaml_path):
    with open(yaml_path, 'r') as file:
        return yaml.safe_load(file)