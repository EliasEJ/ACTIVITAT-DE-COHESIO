# Base de dades

La nostra base de dades està formada per 8 taules, les quals són les següents:

- **Alumne**: Aquesta taula conté les dades dels alumnes que participen.
- **Professor**: Aquesta taula conté les dades dels professors que participen.
- **Administrador**: Aquesta taula conté les dades del administrador que gestion.
- **Material**: Aquesta taula conté les dades dels materials que s'utilitzen.
- **Posició**: Aquesta taula conté les dades de les posicions que s'utilitzen.
- **Activitat**: Aquesta taula conté les dades de les activitats que es realitzen.
- **Grup**: Aquesta taula conté les dades dels grups que participen.
- **Enfrontament**: Aquesta taula conté les dades dels enfrontaments que es realitzen.


## Taula alumne

| alume_id | nom       | cognom   | correu                | password   | curs     | any | classe | grup_id | tutor |
|----------|-----------|----------|-----------------------|------------|----------|-----|--------|---------|-------|
| 1        | Alejandro | Vázquez  | alejandro.vazquez@... | pass123    | DAW      | 2r  | A      | 4       | 1     |
| 2        | Elias     | Jerari   | elias.jerari@...      | pass123    | DAW      | 2n  | A      | 4       | 1     |
| 3        | Martin    | Hernán   | martin.hernan@...     | pass123    | DAW      | 2r  | A      | 4       | 1     |



## Taula professor

| professor_id | nom        | cognom    | user     | password | actividad_id | grup_id | tutor |
|--------------|------------|-----------|----------|----------|--------------|---------|-------|
| 1            | Pere       | Sanchez   | psanchez | pass123  | 2            | 5       | 1     |
| 2            | Ainhoa     | Zaldua    | azaldua  | pass123  | 1            | 6       | 1     |



## Taula administrador

| admin_id | nom     | cognom | user    | password   | correu               | actividad_id | grup_id | tutor |
|----------|---------|--------|---------|------------|----------------------|--------------|---------|-------|
| 1        | Pere    | Sanchez| psanchez| pass123    | psanchez@sapa...     | 5            | 1       | 1     |



## Taula activitat

| actividad_id | nom          | descripcio      | posicion_id | porfessor_id | grup1 | grup2 | material_id |
|--------------|--------------|-----------------|-------------|--------------|-------|-------|-------------|
| 1            | Futbol       | Partit          | 10          | 3            | 3     | 4     | 7           |
| 2            | Basquet      | Partit          | 11          | 4            | 2     | 6     | 8           |



## Taula material

| material_id | nom          | comprar |
|-------------|--------------|---------|
| 1           | Pilota tenis | 0       |
| 2           | Paper        | 1       |



## Taula enfrentaments

| enfrentament_id | activitat_id |  nom     | resultat |
|-----------------|--------------|----------|----------|
| 1               | 1            | Futbol   | 4 - 1    |
| 2               | 2            | Basquet  | 21 - 0   |



## Taula grup

| grup_id | nom     | foto     | puntuacio |
|---------|---------|----------|-----------|
| 1       | DAW-2-A | img.jpg  | 100       |
| 2       | SMX-2-B | img.jpg  | 12        |



## Taula posicio

| posicion_id | nom     | descripcio     |
|-------------|---------|----------------|
| 1           | Futbol  | Camp de futbol |
