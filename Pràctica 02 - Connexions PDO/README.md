# Projecte PHP - Pràctica 02: Connexions PDO

Sistema CRUD (Create, Read, Update, Delete) per gestionar articles utilitzant PHP, PDO i MySQL amb arquitectura MVC.

## 📋 Descripció
Aplicació web per gestionar articles amb les següents funcionalitats:
- ✅ Crear nous articles
- 📖 Llistar tots els articles (generat automàticament)
- ✏️ Actualitzar articles existents
- 🗑️ Eliminar articles

El template fet servir per aquesta pràctica el pots trobar en: https://www.tutorialrepublic.com/snippets/preview.php?topic=bootstrap&file=crud-data-table-for-database-with-modal-form, no està extret de chatgpt 😉

---

## 🎯 Objectius de la Pràctica

### 1. **Connexió segura a base de dades amb PDO**
   - **Motivació:** PDO ofereix una capa d'abstracció que permet canviar de motor de base de dades (MySQL, PostgreSQL, SQLite) sense reescriure codi.
   - **Implementació:** Classe `Database` amb patró Singleton per garantir una única connexió durant el cicle de vida de la petició.
   - **Seguretat:** Ús exclusiu de **prepared statements** per prevenir SQL Injection.

### 2. **Aplicació del patró MVC**
   - **Model:** Classes `Article` (entitat) i `ArticleDAO` (accés a dades) per separar la lògica de negoci.
   - **Vista:** Fitxers PHP (`menu.php`, `create.php`, etc.) que només contenen HTML i codi de presentació.
   - **Controlador:** `ArticleController` gestiona les peticions HTTP i coordina Model-Vista.

### 3. **Gestió d'errors i feedback a l'usuari**
   - Missatges d'èxit/error amb alertes Bootstrap (color-coded: verd=èxit, vermell=error, groc=avís).
   - Validació bàsica de formularis (camps obligatoris, tipus de dades).
   - Gestió d'excepcions PDO per evitar exposar errors SQL a l'usuari final.

### 4. **Experiència d'usuari (UX)**
   - **Tooltips informatius** en botons (Bootstrap + jQuery) per guiar l'usuari.
   - **Truncat de text** a 50 caràcters amb `...` per mantenir taules llegibles.
   - **Responsive design** amb Bootstrap 4.5 per adaptar-se a diferents dispositius.

---

### **Justificació de l'arquitectura:**

#### **Per què MVC?**
- **Separació de responsabilitats:** El codi de presentació (HTML) no es barreja amb la lògica de negoci (PHP).
- **Mantenibilitat:** Canviar el disseny visual no afecta la lògica del controlador o model.
- **Testabilitat:** Es poden provar les classes del model de forma independent.

#### **Per què DAO (Data Access Object)?**
- **Encapsulació:** Tota la lògica SQL està centralitzada en `ArticleDAO`.
- **Reutilització:** Altres controladors poden utilitzar el mateix DAO sense duplicar codi.
- **Migració fàcil:** Si canviem de base de dades, només modifiquem el DAO.

---

## 🗂️ Estructura del Projecte

```
Pràctica 02 - Connexions PDO/
├── app/
│   ├── controller/
│   │   └── ArticleController.php    # Controlador principal (gestiona peticions i lògica)
│   ├── model/
│   │   ├── dao/
│   │   │   └── ArticleDAO.php       # Accés a dades (CRUD a base de dades)
│   │   ├── database/
│   │   │   └── database.php         # Connexió PDO 
│   │   └── entities/
│   │       └── Article.php          # Entitat Article (classe model)
│   └── vista/
│       ├── menu.php                 # Vista principal (llista articles)
│       ├── create.php               # Formulari crear article
│       ├── update.php               # Formulari actualitzar article
│       └── delete.php               # Vista eliminar article
├── public/
│   ├── css/
│   │   └── style.css                # Estils personalitzats
│   └── index.php                    # Punt d'entrada de l'aplicació
└── .gitignore                       # Arxius ignorats per Git
```

## 📁 Descripció dels Fitxers

### **Controller**
| Fitxer | Funció |
|--------|--------|
| `ArticleController.php` | Gestiona les peticions HTTP (GET/POST), crida el DAO i carrega les vistes corresponents segons l'acció (`create`, `update`, `delete`, `list`) |

### **Model - DAO (Data Access Object)**
| Fitxer | Funció |
|--------|--------|
| `ArticleDAO.php` | Implementa operacions CRUD:<br>• `create()` - Inserir article nou<br>• `findById()` - Buscar article per ID<br>• `findAll()` - Obtenir tots els articles<br>• `update()` - Modificar article existent<br>• `delete()` - Eliminar article |

### **Model - Database**
| Fitxer | Funció |
|--------|--------|
| `database.php` | Classe `Database` amb patró Singleton que gestiona la connexió PDO a MySQL. Configura:<br>• DSN (host, dbname, charset)<br>• Opcions PDO (errors, fetch mode)<br>• Mètode `getConnection()` per obtenir la instància PDO |

### **Model - Entities**
| Fitxer | Funció |
|--------|--------|
| `Article.php` | Classe entitat que representa un article amb:<br>• Propietats: `id`, `titol`, `cos`, `dni`<br>• Constructor i getters/setters |

### **Vista**
| Fitxer | Funció |
|--------|--------|
| `menu.php` | Vista principal que mostra la taula d'articles amb alertes Bootstrap (èxit/error) i tooltips |
| `create.php` | Formulari HTML per crear un nou article (camps: títol, cos, DNI) |
| `update.php` | Formulari pre-emplenat per modificar un article existent |
| `delete.php` | Vista de confirmació per eliminar un article |

### **Public**
| Fitxer | Funció |
|--------|--------|
| `index.php` | Punt d'entrada. Inclou l'autoloader, inicialitza el controlador i processa l'acció (`$_GET['action']`) |
| `style.css` | Estils CSS personalitzats per la interfície |


