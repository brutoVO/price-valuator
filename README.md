# Prueba técnica - Senior Developer

## **Contexto**

En Percentil, operamos con un ecosistema tecnológico que combina sistemas legacy robustos con arquitecturas modernas. Nuestro stack principal incluye:

- **API**: Symfony 3.4 / 4.x (PHP 7.2+) con arquitectura orientada a Bundles.
- **Frontend**: Vue.js 2 con Server Side Rendering (SSR) y Webpack.
- **Legacy (Quantil)**: PHP nativo/custom framework para gestión de backoffice y logística.

Buscamos un ingeniero capaz de navegar esta complejidad, proponiendo soluciones limpias, escalables y bien arquitecturadas, facilitando la migración progresiva de lógica legacy a servicios modernos.

---

## **El Reto: "Estimador de Valor de Reventa"**

Tu misión es diseñar e implementar una funcionalidad clave para nuestros usuarios: una herramienta que les permita estimar cuánto podrían ganar vendiendo una prenda específica en Percentil.

Esta funcionalidad debe abarcar desde el backend (lógica de negocio) hasta el frontend (interfaz de usuario), simulando un flujo de trabajo real en nuestro equipo.

### **Requerimientos Técnicos**

### **1. Backend (API - Symfony)**

Debes crear un nuevo endpoint (o simular su creación dentro de un Bundle existente, ej: `PricingBundle`) que acepte las características de una prenda y devuelva un rango de precio estimado.

- **Endpoint**: `POST /api/v1/valuation/estimate`
- **Input**: JSON con `brand` (string), `category` (string), `condition` (enum: 'new', 'good', 'fair').
- **Lógica de Negocio**:
    - Implementar un servicio `ValuationService` que calcule el precio base.
    - **Requisito Arquitectónico**: Utilizar un **Patrón de Diseño** (ej: *Strategy*, *Chain of Responsibility* o *Decorator*) para aplicar reglas de negocio dinámicas.
        - *Ejemplo de reglas*: "Si la marca es 'Zara', añade un 10%", "Si el estado es 'nuevo', multiplica por 1.5", "Si es temporada alta, suma un bonus".
    - La persistencia de datos puede ser simulada (Mock Repositories), no es necesario levantar una base de datos real, pero el código debe estar preparado para conectarse a Doctrine ORM.

### **2. Frontend (Mayhem SSR - Vue.js)**

Implementar un componente Vue.js que consuma este endpoint.

- **Componente**: `ValuationEstimator.vue`.
- **Funcionalidad**: Formulario sencillo para introducir los datos y mostrar el resultado (o errores).
- **Estado**: Gestionar el estado de carga (loading), éxito y error.
- **Estilo**: Uso básico de SCSS/Sass. Se valora la estructura del CSS (BEM o Scoped CSS).

### **3. Testing**

- **Unit Testing (PHP)**: Escribir tests unitarios para el `ValuationService` usando PHPUnit. Es crítico demostrar cómo testeas la lógica de precios aislada de la infraestructura.
- **Opcional**: Test de componente Vue (Jest/Vue Test Utils).

---

## 🧪 **Criterios de Evaluación Detallados**

### 1. **Código Limpio y Estructurado**
### 2. **Arquitectura**
### 3. **Testing**
### 4. **Documentación**
### 5. **Justificación Técnica**

## **Entregable**

Por favor, provee un repositorio Git (GitHub/GitLab/Bitbucket) con el código. No es necesario que sea un proyecto funcional completo (dockerizado), pero sí que la estructura de carpetas y los archivos de código sean coherentes y ejecutables (especialmente los tests).

**Tiempo estimado**: 3-4 horas.
