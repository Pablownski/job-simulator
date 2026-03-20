# ⚽ Players API — REST CRUD (PHP + PostgreSQL + Docker)

## 📌 Descripción

Este proyecto implementa una **API REST CRUD** para la gestión de jugadores, desarrollada en **PHP** con persistencia en **PostgreSQL** y totalmente containerizada con **Docker**.

La API cumple con el contrato requerido y es consumida por un frontend provisto.

---

## 🧱 Estructura del proyecto

```
/project-root
│
├── backend/
│   ├── index.php          # Router principal
│   ├── controller.php     # Lógica CRUD
│   ├── db.php             # Conexión a PostgreSQL
│   ├── validator.php      # Validaciones
│   ├── .htaccess          # Rewrite para rutas REST
│   └── Dockerfile.php     # Imagen del backend
│
├── frontend/              # Cliente (HTML + JS + Nginx)
│
├── sql/
│   └── schema.sql         # Creación de tabla + datos iniciales
│
├── docker-compose.yml     # Orquestación de servicios
├── .env                   # Variables de entorno (NO versionado)
├── .env.example           # Ejemplo de configuración
├── .gitignore
```

---

## ⚙️ Tecnologías utilizadas

* PHP 8.2 (Apache)
* PostgreSQL 15
* Docker & Docker Compose
* JavaScript (frontend)
* Nginx

---

## 🐳 Ejecución del proyecto

### 1. Clonar repositorio

```bash
git clone <repo-url>
cd project-root
```

---

### 2. Crear archivo `.env`

```env
DB_HOST=db
DB_PORT=5432
DB_NAME=players_db
DB_USER=postgres
DB_PASSWORD=postgres

APP_PORT=8080
```

---

### 3. Levantar servicios

```bash
docker compose down -v
docker compose up --build
```

---

### 4. Acceso a la aplicación

* API → http://localhost:8080/players
* Frontend → http://localhost:8088

---

## 🐘 Base de datos

La base de datos se inicializa automáticamente al iniciar Docker mediante:

```
/docker-entrypoint-initdb.d/schema.sql
```

### Tabla creada

* `players`

Campos:

| Campo          | Tipo    | Descripción        |
| -------------- | ------- | ------------------ |
| id             | integer | PK autoincremental |
| nombre         | string  | nombre del jugador |
| equipo         | string  | equipo             |
| posicion       | string  | posición           |
| edad           | integer | edad               |
| promedio_goles | float   | promedio           |
| activo         | boolean | estado             |

---

## 🔌 Endpoints disponibles

### GET — listar todos

```
GET /players
```

### GET — obtener uno

```
GET /players/{id}
```

### POST — crear

```
POST /players
```

### PUT — actualizar

```
PUT /players/{id}
```

### DELETE — eliminar

```
DELETE /players/{id}
```

---

## 📦 Ejemplo de request (POST)

```json
{
  "campo1": "Messi",
  "campo2": "Inter Miami",
  "campo3": "Delantero",
  "campo4": 36,
  "campo5": 0.85,
  "campo6": true
}
```

---

## 📊 Posibles respuestas

### ✔ 200 OK

Operación exitosa

### ✔ 201 Created

Recurso creado correctamente

### ✔ 204 No Content

Recurso eliminado

### ❌ 400 Bad Request

Datos inválidos

### ❌ 404 Not Found

Recurso no encontrado

### ❌ 500 Internal Server Error

Error en servidor o base de datos

---

## 🔐 Validaciones

Todos los campos son obligatorios:

* `campo1`, `campo2`, `campo3` → string
* `campo4` → integer
* `campo5` → float
* `campo6` → boolean

---

## 🌐 CORS

La API permite peticiones desde cualquier origen para integración con frontend:

```
Access-Control-Allow-Origin: *
```

---

## 🧠 Consideraciones técnicas

* Se implementó retry en la conexión a la base de datos
* Se utiliza `.htaccess` para manejo de rutas REST
* No se utilizan variables hardcodeadas (uso de `.env`)
* La base de datos persiste mediante volumen Docker

---

## 🚀 Pruebas

Se pueden realizar mediante:

* Navegador (GET)
* Postman / Thunder Client
* Frontend incluido

---

## 📌 Requisitos cumplidos (Nivel MID)

✔ CRUD completo
✔ PostgreSQL
✔ Docker con múltiples servicios
✔ Variables de entorno
✔ Validaciones
✔ Códigos HTTP correctos
✔ Persistencia de datos
✔ Integración con frontend

---

## 🎯 Bonus

✔ Integración frontend + backend en un solo `docker-compose`

---

## 👨‍💻 Autor

Proyecto desarrollado como parte de evaluación técnica de API REST.
