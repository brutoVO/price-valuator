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

Debes crear un nuevo endpoint (o simular su creación dentro de un Bundle existente, ej: `PricingBundle`) que acepte las características de una prenda y devuelva un rango de precio estimado.

- **Endpoint**: `POST /api/v1/valuation/estimate`
- **Input**: JSON con `brand` (string), `category` (string), `condition` (enum: 'new', 'good', 'fair').
- **Lógica de Negocio**:
    - Implementar un servicio `ValuationService` que calcule el precio base.
    - **Requisito Arquitectónico**: Utilizar un **Patrón de Diseño** (ej: *Strategy*, *Chain of Responsibility* o *Decorator*) para aplicar reglas de negocio dinámicas.
        - *Ejemplo de reglas*: "Si la marca es 'Zara', añade un 10%", "Si el estado es 'nuevo', multiplica por 1.5", "Si es temporada alta, suma un bonus".
    - La persistencia de datos puede ser simulada (Mock Repositories), no es necesario levantar una base de datos real, pero el código debe estar preparado para conectarse a Doctrine ORM.

### **2. Frontend (Mayhem SSR - Vue.js)**

Implementar un componente Vue.js que consuma este endpoint.

- **Componente**: `ValuationEstimator.vue`.
- **Funcionalidad**: Formulario sencillo para introducir los datos y mostrar el resultado (o errores).
- **Estado**: Gestionar el estado de carga (loading), éxito y error.
- **Estilo**: Uso básico de SCSS/Sass. Se valora la estructura del CSS (BEM o Scoped CSS).

### **3. Testing**

- **Unit Testing (PHP)**: Escribir tests unitarios para el `ValuationService` usando PHPUnit. Es crítico demostrar cómo testeas la lógica de precios aislada de la infraestructura.
- **Opcional**: Test de componente Vue (Jest/Vue Test Utils).

---

## 🧪 **Criterios de Evaluación Detallados**

### 1. **Código Limpio y Estructurado**

**Puntos a evaluar:**

- **Legibilidad del código:**
    - Uso adecuado de indentación, saltos de línea y espaciado.
    - Claridad visual y orden lógico del código.
- **Uso correcto y consistente de convenciones:**
    - Nombres claros y autoexplicativos para variables, funciones, clases y métodos.
    - Consistencia en la elección de patrones (camelCase, snake_case, PascalCase, según el lenguaje).
- **Comentarios pertinentes:**
    - Comentarios que aporten valor real, explicando decisiones no obvias.
    - Evitar comentarios redundantes (el código debería explicarse por sí mismo).
- **Sencillez y eficiencia:**
    - Código sencillo y directo, evitando complejidades innecesarias.
    - Buen balance entre rendimiento y claridad.

**Consideraciones adicionales:**

- ¿Es este código fácil de mantener a largo plazo?
- ¿Puede un nuevo desarrollador entender rápidamente lo que hace el código?

---

### 2. **Arquitectura**

**Puntos a evaluar:**

- **Modularidad y separación de responsabilidades:**
    - Código estructurado en componentes o módulos claramente delimitados, con responsabilidades bien definidas (principio de responsabilidad única).
    - Evitar lógica duplicada o excesivamente acoplada.
- **Escalabilidad:**
    - Capacidad de añadir nuevas funcionalidades o expandir el sistema sin grandes modificaciones estructurales.
    - Flexibilidad para adaptarse a nuevas integraciones con otros sistemas o servicios.
- **Manejo de errores y excepciones:**
    - Buena gestión de excepciones, con respuestas claras y significativas.
    - Logs estructurados que faciliten el debugging y monitorización.
- **Uso adecuado de patrones de diseño y buenas prácticas:**
    - Aplicación apropiada de patrones de diseño (Factory, Singleton, Observer, Repository, etc.).
    - Evaluar decisiones de diseño y la elección de frameworks o bibliotecas externas.

**Consideraciones adicionales:**

- ¿Es fácil hacer cambios sin romper funcionalidades existentes?
- ¿La estructura está orientada a reutilización en diferentes contextos (multi-marca, multi-país)?

---

### 3. **Testing**

**Puntos a evaluar:**

- **Cobertura de tests:**
    - Presencia de tests unitarios cubriendo los casos críticos del código.
    - Existencia de pruebas que verifiquen comportamiento esperado y manejo de errores.
- **Calidad de las pruebas:**
    - Tests relevantes, que aportan valor y seguridad al sistema.
    - Pruebas fáciles de entender, mantener y actualizar.
- **Pruebas de integración (si aplicable):**
    - Evaluar si hay pruebas que validen las integraciones entre distintos componentes del sistema.
- **Uso de mocks y stubs (si aplicable):**
    - Uso inteligente y justificado de mocks/stubs para probar partes específicas del sistema.

**Consideraciones adicionales:**

- ¿Confías en que los tests detectarán futuros errores o regresiones?
- ¿Qué tan fácil es añadir nuevos tests al proyecto?

---

### 4. **Documentación**

**Puntos a evaluar:**

- **Claridad y facilidad de comprensión:**
    - Documentación sencilla, clara y directa sobre cómo ejecutar el código, tests y funcionalidades.
- **Uso de ejemplos prácticos:**
    - Presencia de ejemplos reales o snippets de código mostrando cómo consumir endpoints, ejecutar procesos, etc.
- **Guías de configuración y despliegue:**
    - Documentación clara sobre cómo configurar el entorno y desplegar el servicio o API.
- **Documentación técnica interna:**
    - Explicación breve sobre decisiones técnicas relevantes.
    - Documentación integrada en el código o en README para futuros desarrolladores.

**Consideraciones adicionales:**

- ¿Podría un nuevo integrante del equipo ejecutar rápidamente el proyecto usando solo esta documentación?
- ¿La documentación facilita futuras actualizaciones o expansiones?

---

### 5. **Justificación Técnica**

**Puntos a evaluar:**

- **Fundamentación sólida de decisiones técnicas:**
    - Claridad en las razones detrás de la elección del stack tecnológico, frameworks y bibliotecas utilizados.
- **Conciencia de trade-offs técnicos:**
    - Capacidad para reconocer pros y contras en las decisiones tomadas (por ejemplo, rapidez vs escalabilidad, simplicidad vs robustez).
- **Razonamiento en términos de negocio y producto:**
    - Justificación que considera objetivos del negocio, no solo criterios técnicos puros.
- **Conocimiento profundo de las herramientas usadas:**
    - Evidencia de conocimiento real y profundo de las tecnologías seleccionadas, no simplemente copia y pega de documentación.

**Consideraciones adicionales:**

- ¿Es consciente el candidato del impacto real que tendrán sus decisiones en la empresa o proyecto?
- ¿Sus decisiones demuestran una experiencia técnica sólida, visión estratégica y orientación al negocio?

## **Entregable**

Por favor, provee un repositorio Git (GitHub/GitLab/Bitbucket) con el código. No es necesario que sea un proyecto funcional completo (dockerizado), pero sí que la estructura de carpetas y los archivos de código sean coherentes y ejecutables (especialmente los tests).

**Tiempo estimado**: 3-4 horas.

---

## 🚀 Quick Start & Demo

Follow these steps to get the project up and running in minutes:

1. **Clone the repository:**
   ```bash
   git clone <repo-url>
   cd price-valuator
   ```

2. **Prepare Environment:**
   Create a `.env.local` file to sync your local user ID with the Docker container (avoids permission issues):
   ```bash
   echo "UID=$(id -u)" > .env.local
   echo "GID=$(id -g)" >> .env.local
   ```

3. **Initialize & Build:**
   This command installs all dependencies (PHP & Node) and compiles the assets:
   ```bash
   make install
   ```

4. **Start Infrastructure:**
   ```bash
   make up
   ```

5. **Run All Tests (Backend & Frontend):**
   ```bash
   make test
   ```

6. **Try the Demo:**
   
   **Option A: Browser**
   Open [http://localhost:8080](http://localhost:8080) in your browser.
   
   **Option B: CURL (API)**
   ```bash
   curl -X POST http://localhost:8080/api/v1/valuation/estimate \
     -H "Content-Type: application/json" \
     -d '{
       "brand": "Zara",
       "condition": "new",
       "is_high_season": true
     }'
   ```

   **Expected Result:**
   - **Price:** `26.5`
   - **Logic:** Base 10€ * 1.10 (Zara) * 1.5 (New) + 10€ (Season)
