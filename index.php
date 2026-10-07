<?php
// Configuración de conexión con Railway / Localhost
$host = getenv('MYSQLHOST') ?: "localhost";
$port = getenv('MYSQLPORT') ?: "3306";
$user = getenv('MYSQLUSER') ?: "root";
$pass = getenv('MYSQLPASSWORD') ?: "";
$db   = getenv('MYSQLDATABASE') ?: "railway";

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Asegurar soporte para acentos y caracteres especiales
mysqli_set_charset($conexion, "utf8mb4");

// Lógica de procesamiento del formulario
$mensajePHP = "";
if (isset($_POST['enviar'])) {
    // Sanitizar y limpiar el texto ingresado para evitar errores de SQL e inyecciones
    $comentario = mysqli_real_escape_string($conexion, trim($_POST['comentario']));
    
    if (!empty($comentario)) {
        // CORRECCIÓN CLAVE: El texto en SQL debe ir entre comillas '$comentario'
        $sql = "INSERT INTO parecio (comentario) VALUES ('$comentario')";
        $query = mysqli_query($conexion, $sql);

        if ($query) {
            $mensajePHP = "<div class='mensaje-confirmacion' style='display:block;'>¡Muchas gracias! Tu opinión ha sido enviada con éxito y nos ayuda a mejorar 🌱.</div>";
        } else {
            $mensajePHP = "<div class='caja-alerta'>Error al guardar en la base de datos: " . mysqli_error($conexion) . "</div>";
        }
    } else {
        $mensajePHP = "<div class='caja-alerta'>Por favor, escribe un comentario antes de enviar.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía Completa sobre la Composta Casera</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header id="encabezado-principal">
        <h1 id="titulo-principal">Guía Práctica: Cómo Hacer Composta en Casa</h1>
        <nav id="menu-navegacion">
            <ul>
                <li><a href="#introduccion">Introducción</a></li>
                <li><a href="#beneficios">Beneficios</a></li>
                <li><a href="#materiales">Materiales</a></li>
                <li><a href="#proceso">Paso a Paso</a></li>
                <li><a href="#mantenimiento">Cuidados</a></li>
                <li><a href="#interactivo">Verificar Estado</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main id="contenido-principal">
        
        <section id="introduccion" class="seccion">
            <h2>¿Qué es la Composta?</h2>
            <p>La composta es el resultado del proceso de descomposición biológica de la materia orgánica de origen vegetal y animal. A través de este proceso, microorganismos como bacterias, hongos y pequeños invertebrados (como lombrices y escarabajos) transforman los residuos orgánicos en un abono natural rico en nutrientes esenciales para la tierra.</p>
            <p>Hacer composta en casa es una de las acciones ecológicas más efectivas que podemos realizar a nivel individual para reducir nuestra huella ambiental y devolverle nutrientes al suelo.</p>
            <img src="Composta.jpg" alt="Proceso de composta en el jardín" class="img-seccion">
        </section>

        <section id="beneficios" class="seccion">
            <h2>Beneficios del Compostaje Orgánico</h2>
            <p>El compostaje trae consigo grandes ventajas tanto para el medio ambiente como para la economía del hogar:</p>
            <ul class="lista-beneficios">
                <li><strong>Reducción de residuos:</strong> Hasta un 40% de los residuos sólidos que generamos en casa son orgánicos y pueden compostarse en lugar de ir a los basureros.</li>
                <li><strong>Mejora de la estructura del suelo:</strong> Aumenta la retención de agua y humedad en el suelo, permitiendo que las plantas resistan mejor las sequías.</li>
                <li><strong>Nutrientes naturales:</strong> Aporta nitrógeno, fósforo, potasio y micronutrientes sin necesidad de fertilizantes químicos sintéticos.</li>
                <li><strong>Disminución de gases contaminantes:</strong> Evita la descomposición anaeróbica en vertederos, la cual genera metano, un potente gas de efecto invernadero.</li>
            </ul>
        </section>

        <section id="materiales" class="seccion">
            <h2>Materiales Permitidos y No Permitidos</h2>
            <p>Para mantener un buen equilibrio biológico en la composta, es fundamental diferenciar entre los materiales ricos en nitrógeno (verdes) y los ricos en carbono (cafés).</p>
            
            <div class="columnas-materiales">
                <div class="caja-materiales verdes">
                    <h3>Materiales Verdes (Nitrógeno / Húmedos)</h3>
                    <ul>
                        <li>Cáscaras de frutas y restos de verduras.</li>
                        <li>Posos y restos de café molido.</li>
                        <li>Bolsitas de té e infusiones naturales.</li>
                        <li>Cascarones de huevo triturados.</li>
                        <li>Pastos y césped recién cortado.</li>
                    </ul>
                </div>

                <div class="caja-materiales cafes">
                    <h3>Materiales Cafés (Carbono / Secos)</h3>
                    <ul>
                        <li>Hojas secas de árboles y arbustos.</li>
                        <li>Ramas delgadas y trozos de madera.</li>
                        <li>Cartón desmenuzado sin tintas plásticas.</li>
                        <li>Servilletas y papel de cocina no graso.</li>
                        <li>Aserrín y virutas de madera limpia.</li>
                    </ul>
                </div>
            </div>

            <img src="composta-como-se-hace.jpg" alt="Separación de materiales verdes y cafés" class="img-seccion">

            <div class="caja-alerta">
                <h3>⚠️ Lo que NUNCA debes agregar:</h3>
                <p>Evita restos de carne, huesos, lácteos, aceites, heces de mascotas (perros/gatos) o plantas enfermas, ya que atraen plagas y generan malos olores.</p>
            </div>
        </section>

        <section id="proceso" class="seccion">
            <h2>Paso a Paso para Elaborar tu Composta</h2>
            <ol class="lista-pasos">
                <li><strong>Elige el contenedor:</strong> Puedes usar un huacal de madera, una cubeta de plástico con agujeros para ventilación o hacer un espacio directo en el suelo.</li>
                <li><strong>Capa base (Drenaje):</strong> Coloca una primera capa de 5 a 10 cm de ramas gruesas o trozos de cartón en el fondo para favorecer el aireado.</li>
                <li><strong>Capas alternadas:</strong> Añade una capa de residuos verdes (húmedos) y cúbrela con una capa de materiales cafés (secos). La regla general es poner el doble de materia café que verde.</li>
                <li><strong>Humedad y Aireación:</strong> La mezcla debe estar húmeda como una esponja escurrida. Remueve la composta cada semana para oxigenarla.</li>
            </ol>
            <img src="images.jpg" alt="Estructura por capas para la composta" class="img-seccion">
        </section>

        <section id="mantenimiento" class="seccion">
            <h2>Mantenimiento y Solución de Problemas</h2>
            <p>Monitorear tu composta te garantizará obtener un abono oscuro, con olor a tierra mojada y textura esponjosa en aproximadamente 2 a 4 meses.</p>
            <table class="tabla-mantenimiento">
                <thead>
                    <tr>
                        <th>Síntoma / Problema</th>
                        <th>Causa Probable</th>
                        <th>Solución Recomendada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Olor desagradable o podrido</td>
                        <td>Exceso de humedad o falta de aire</td>
                        <td>Mezclar, oxigenar y agregar materiales secos (cafés).</td>
                    </tr>
                    <tr>
                        <td>La mezcla no se descompone</td>
                        <td>Falta de humedad o de nitrógeno</td>
                        <td>Rociar un poco de agua o agregar más restos verdes.</td>
                    </tr>
                    <tr>
                        <td>Presencia de mosquitas de fruta</td>
                        <td>Materia verde expuesta en la superficie</td>
                        <td>Cubrir siempre los restos de comida con una capa de hojas secas.</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section id="interactivo" class="seccion interactiva">
            <h2>Asistente de Diagnóstico del Estado de tu Composta</h2>
            <p>Haz clic en el botón según la apariencia actual de tu composta para recibir un consejo instantáneo sobre su cuidado:</p>
            
            <div class="botones-estado">
                <button id="btnHumedo" class="btn-interactivo">Siento la composta muy seca</button>
                <button id="btnOlor" class="btn-interactivo">Tiene un olor muy fuerte / feo</button>
                <button id="btnListo" class="btn-interactivo">Ya se ve oscura y huele a tierra</button>
            </div>

            <div id="panel-diagnostico" class="caja-diagnostico">
                <p id="textoDiagnostico">Selecciona una opción arriba para revisar el estado de tu composta.</p>
            </div>
        </section>

        <!-- SECCIÓN DE CONTACTO Y FORMULARIO CORREGIDA -->
        <section id="contacto" class="seccion">
            <h2>Envíanos tu experiencia o sugerencia</h2>
            <p>¿Qué te pareció la información sobre la composta casera? Déjanos un comentario corto para saber tu opinión:</p>
            
            <form action="" method="POST" class="form-consulta">
                <div class="campo-form">
                    <label for="comentario">Tu comentario o duda:</label>
                    <textarea id="comentario" name="comentario" rows="4" placeholder="Ej. Me sirvió mucho la tabla de materiales permitidos..." required></textarea>
                </div>

                <button type="submit" name="enviar" class="btn-enviar">Enviar Opinión</button>
            </form>

            <!-- Mensaje de respuesta desplegado desde PHP -->
            <?php echo $mensajePHP; ?>
        </section>

    </main>

    <footer id="pie-pagina">
        <div class="info-alumno">
            <p><strong>Elaborado por:</strong> Fabian Emir Pineda Hernandez</p>
            <p><strong>Grupo y Turno:</strong> 5° Semestre Grupo D - Turno Mañana</p>
        </div>
        <div class="referencias">
            <h4>Fuentes y Referencias Consultadas:</h4>
            <ul>
                <li><a href="https://www.gob.mx/semarnat" target="_blank">SEMARNAT - Guía Práctica de Compostaje Casero</a></li>
                <li><a href="https://www.fao.org/organicag" target="_blank">FAO - Manual de Elaboración de Abonos Orgánicos</a></li>
                <li><a href="https://www.unam.mx" target="_blank">UNAM - Guía Comunitaria de Manejo de Residuos Orgánicos</a></li>
            </ul>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    
            const btnHumedo = document.getElementById('btnHumedo');
            const btnOlor = document.getElementById('btnOlor');
            const btnListo = document.getElementById('btnListo');
            const textoDiagnostico = document.getElementById('textoDiagnostico');
            const panelDiagnostico = document.getElementById('panel-diagnostico');
            const tituloPrincipal = document.getElementById('titulo-principal');

            btnHumedo.addEventListener('click', function() {
                textoDiagnostico.textContent = "💡 Consejo: Agrega un poco de agua en forma de rocío o incorpora más restos húmedos (cáscaras de fruta). La composta debe sentirse como una esponja húmeda.";
                panelDiagnostico.style.backgroundColor = "#fff3cd";
                panelDiagnostico.style.borderColor = "#ffeba1";
                textoDiagnostico.style.color = "#856404";
            });

            btnOlor.addEventListener('click', function() {
                textoDiagnostico.textContent = "⚠️ Atención: El mal olor ocurre cuando hay mucha humedad o falta de oxígeno. Remueve todo con un palo para airear y agrega 2 o 3 puñados de hojas secas o cartón picado.";
                panelDiagnostico.style.backgroundColor = "#f8d7da";
                panelDiagnostico.style.borderColor = "#f5c6cb";
                textoDiagnostico.style.color = "#721c24";
            });

            btnListo.addEventListener('click', function() {
                textoDiagnostico.textContent = "🎉 ¡Felicidades! Tu composta está madura y lista para usarse. Puedes mezclarla con la tierra de tus macetas o jardín para nutrir tus plantas.";
                panelDiagnostico.style.backgroundColor = "#d4edda";
                panelDiagnostico.style.borderColor = "#c3e6cb";
                textoDiagnostico.style.color = "#155724";
            });

            tituloPrincipal.addEventListener('mouseenter', function() {
                tituloPrincipal.style.color = "#a5d6a7";
            });

            tituloPrincipal.addEventListener('mouseleave', function() {
                tituloPrincipal.style.color = "#ffffff";
            });

        });
    </script>
</body>
</html>