# 🎉 Welcome to the Builder Tool! 🎉

The Builder Tool is designed to simplify your configuration management process, making it easy to create and maintain your setup.

## 🚀 Features

- Easy configuration file creation
- History tracking of configurations
- User-friendly input prompts
- YAML and JSON support
- Logging for better debugging

---

## 📦 Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Configuration Defaults](#configuration-defaults)
- [History Management](#history-management)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

---

## 🛠️ Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/lalaio1/AnyFuck-Base-Builder
   cd AnyFuck-Base-Builder
   ```

2. Install the required dependencies:
   ```bash
   pip install -r requirements.txt
   ```

---

## 📜 Usage

To start the Builder Tool, run the following command:

```bash
python Builder.py
```

### Example Configuration

Here’s an example of how the configuration looks:

| Key               | Default Value                   | Description                                      |
|-------------------|---------------------------------|--------------------------------------------------|
| `anydeskURL`      | `http://download.anydesk.com/...` | URL for downloading the AnyDesk executable       |
| `installPath`     | `C:\ProgramData\AnyDesk`       | Directory for AnyDesk installation                |
| `password`        | `917bhasudbg7`                 | Main access password                             |
| `adminUsername`   | `oldadministrator`              | Administrator username                           |
| `adminPassword`   | `lalaio1`                      | Administrator password                           |
| `webhookURL`      | `YOUR_DISCORD_WEBHOOK_URL`     | Discord webhook URL for notifications            |

---

## 🔄 Configuration Defaults

Configuration defaults are stored in a YAML file, which can be easily modified:

```yaml
anydeskURL:
  value: "http://download.anydesk.com/AnyDesk.exe"
  desc: "[i] URL para download do executável do AnyDesk"
installPath:
  value: "C:\\ProgramData\\AnyDesk"
  desc: "[i] Diretório onde o AnyDesk será instalado"
password:
  value: "917bhasudbg7"
  desc: "[i] Senha principal de acesso"
adminUsername:
  value: "oldadministrator"
  desc: "[i] Nome do usuário administrador"
adminPassword:
  value: "lalaio1"
  desc: "[i] Senha do usuário administrador"
webhookURL:
  value: "YOUR_DISCORD_WEBHOOK_URL"
  desc: "[i] URL do webhook do Discord para notificações"
```

---

## 📚 History Management

The Builder Tool keeps track of previous configurations, allowing you to revert or review changes easily.

### Load History

You can load history from a JSON file, which will give you insight into your past configurations.

## 🖥️ API Integration

The Builder Tool includes a simple API located at `./api`, allowing for seamless integration and interaction with your configurations.

For detailed documentation, please refer to the [API Documentation](https://github.com/lalaio1/AnyFck-Base-Builder/tree/main/api).
