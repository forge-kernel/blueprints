# Forge Blueprints

This repository contains the official blueprints for the Forge PHP framework.

## Available Blueprints

| Blueprint  | Description                                                                                 |
| ---------- | ------------------------------------------------------------------------------------------- |
| **blank**  | Minimal Forge project with just the package manager. Ideal for building from scratch.       |
| **minimal**| Full-featured blueprint with package manager and welcome page. Ready for web applications.  |

## Structure

```
blueprints/
├── blank/           # Blank blueprint source files
└── minimal/         # Minimal blueprint source files
```

## Publishing a Version

Use the Forge CLI to build and publish a new blueprint version:

```bash
php forge.php dev:blueprint:version --name=<blueprint-name>
```

This will create a ZIP archive and update the blueprints.json manifest.
