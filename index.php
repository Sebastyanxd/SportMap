<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportMaps</title>
    <link rel="stylesheet" href="style3.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>


    <header class="header">
        <a href="#home" class="logo"> Sport
            <span>Maps</span></a>

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="index.php" class="active">Home</a>
            <a href="#services">Servicios</a>
            <a href="#contact">Contacto</a>
            <a href="agendar.php">Agendar</a>
            <a href="misreservas.php">Mis reservas</a>
            <a href="logout.php">Cerrar sesion</a>

        </nav>
    </header>

    <section class="home" id="home">
        <div class="home-content">
            <h1>Sport <span>Maps</span></h1>
            <h3 class="text-animation">Sobre Nosotros<span>
                </span></h3>
            <p>En SportMaps, facilitamos la búsqueda y reserva de canchas deportivas en centros comunitarios y clubes
                deportivos de manera rápida y sencilla. A través de nuestra plataforma, los usuarios pueden seleccionar
                su comuna, elegir el centro deportivo de su preferencia y acceder a un listado de canchas disponibles
                junto con sus horarios. Nuestro objetivo es ofrecer un sistema de reservas ágil y accesible, ayudando a
                los deportistas a encontrar el lugar ideal para practicar sus actividades físicas sin complicaciones.
            </p>

            <div class="social-icons">
                <a href="#"><i class='bx bx-link'></i></a>
                <a href="#"><i class='bx bxs-store'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxs-car-garage'></i></a>
            </div>

            <div class="btn-group">
                <a href="#" class="btn">Hire</a>
                <a href="#contact" class="btn">Contacto</a>
            </div>
        </div>
        <div class="home-img">
            <img src="images/images2/bernabeu.png" alt="">
        </div>

    </section>

    <section class="education" id="education">
        <h2 class="heading"> Info</h2>

        <div class="timeline-items">

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-data">2024
                </div>
                <div class="timeline-content">
                    <h3>Peñaflor</h3>
                    <p>Peñaflor ofrece una variedad de canchas y centros deportivos que incluyen instalaciones de fútbol
                        y tenis. Los centros están ubicados cerca de parques y áreas residenciales, proporcionando un
                        espacio ideal para el deporte y la recreación en un ambiente natural.</p>
                </div>

            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-data">2024</div>
                <div class="timeline-content">
                    <h3>Talagante</h3>
                    <p>En Talagante, contamos con canchas modernas y bien equipadas. Ubicadas en diferentes sectores de
                        la comuna, ofrecen fácil acceso y disponibilidad de horarios, ideales para organizar torneos o
                        simplemente disfrutar de una actividad deportiva en equipo.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-data">2024</div>
                <div class="timeline-content">
                    <h3>Cerrillos</h>
                        <p>Cerrillos dispone de centros deportivos accesibles y bien conectados. Ofrecemos una variedad
                            de canchas con instalaciones de calidad, tanto para prácticas como para competiciones, en un
                            ambiente seguro y adecuado para todas las edades.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-data">2024</div>
                <div class="timeline-content">
                    <h3>Otros</h3>
                    <p>.......</p>
                </div>
            </div>


        </div>
    </section>

    <section class="services" id="services">
        <h2 class="heading">Services</h2>

        <div class="services-container">
            <div class="service-box">
                <div class="service-info">
                    <h4>Arriendo de Canchas</h4>
                    <p>Ofrecemos el arriendo de canchas deportivas con instalaciones de primera calidad, adaptadas para
                        distintos deportes como fútbol y tenis. Nuestros espacios están diseñados para proporcionar una
                        experiencia cómoda y profesional a nuestros usuarios.</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Venta de Membresías</h4>
                    <p>Disponemos de membresías mensuales y anuales que ofrecen acceso a nuestras canchas y descuentos
                        exclusivos. Estas membresías son ideales para quienes buscan una experiencia continua y
                        accesible en nuestras instalaciones.</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Estacionamiento</h4>
                    <p>Contamos con estacionamiento amplio y seguro para nuestros clientes. Así podrás disfrutar de tu
                        tiempo en nuestras canchas sin preocupaciones sobre la seguridad de tu vehículo.</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Arriendo de Balones</h4>
                    <p>Para tu conveniencia, ofrecemos balones en arriendo para que siempre dispongas del equipamiento
                        necesario para tu práctica deportiva, incluso si olvidas traer el tuyo.</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Forma de pago</h4>
                    <p>Aceptamos diversas formas de pago, incluyendo tarjetas de crédito, débito y pagos en efectivo,
                        para que puedas realizar tus transacciones de manera rápida y segura.</p>
                </div>
            </div>
        </div>
    </section>

    <sectiion class="testimonials" id="testimonials">
        <div class="testimonials-box">
            <h2 class="heading">testimonials</h2>

            <div class="wrapper">
                <div class="testimonial-item">
                    <img src="images/images2/kevin.jpg" alt="">
                    <h2>Kevin</h2>
                    <div class="rating">
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates itaque aut velit sequi,
                        architecto accusamus sunt labore et laborum a ullam accusantium. Facilis, corrupti? Tempore
                        asperiores omnis quaerat quis officia!</p>

                </div>

                <div class="testimonial-item">
                    <img src="images/images2/cabezon.png" alt="">
                    <h2>Sebastian</h2>
                    <div class="rating">
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates itaque aut velit sequi,
                        architecto accusamus sunt labore et laborum a ullam accusantium. Facilis, corrupti? Tempore
                        asperiores omnis quaerat quis officia!</p>

                </div>

                <div class="testimonial-item">
                    <img src="images/images2/palacios.jpg" alt="">
                    <h2>Palacios</h2>
                    <div class="rating">
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates itaque aut velit sequi,
                        architecto accusamus sunt labore et laborum a ullam accusantium. Facilis, corrupti? Tempore
                        asperiores omnis quaerat quis officia!</p>
                </div>
            </div>
        </div>
    </sectiion>

    <section class="contact" id="contact">
        <h2 class="heading">contact <span>Me</span>
        </h2>

        <form action="">
            <div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="Full Name">
                    <input type="email" placeholder="Email">
                </div>
                <div class="input-box">
                    <input type="number" placeholder="Phone Number">
                    <input type="text" placeholder="Subject">
                </div>
            </div>

            <div class="input-group-2">
                <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
                <input type="submit" value="Send Messenge" class="btn">
            </div>
        </form>
    </section>

    <footer class="footer">
        <div class="social">
            <a href="#"><i class='bx bx-link'></i></a>
            <a href="#"><i class='bx bxs-store'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxs-car-garage'></i></a>
        </div>

        <ul class="list">
            <li>
                <a href="#">FAQ</a>
            </li>

            <li>
                <a href="#">Servicios</a>
            </li>

            <li>
                <a href="#">About SportMaps</a>
            </li>

            <li>
                <a href="#">Contact</a>
            </li>

            <li>
                <a href="#">Testimonials</a>
            </li>
        </ul>
        <p class="copyright">
            @ SportMaps | All Rights
        </p>
    </footer>

    <script src="script.js"></script>
</body>

</html>