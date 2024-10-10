<?php
session_start(); // Iniciar sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirigir a login.php si no está autenticado
    exit();
}
?>

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
            <a href="#home" class="active">Home</a>
            <a href="#services">Servicios</a>
            <a href="mapa.php">Mapa</a>
            <a href="#contact">Contacto</a>
            <a href="logout.php">Cerrar sesion</a>
        </nav>
    </header>

    <section class="home" id="home">
        <div class="home-content">
            <h1>hi, It's <span>Maps</span></h1>
            <h3 class="text-animation">I'm a <span>
                </span></h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minus accusantium aperiam molestiae. Quis
                maxime nemo voluptas cumque assumenda libero, possimus asperiores, deserunt aliquam eveniet nesciunt
                debitis quibusdam nulla ut et!</p>

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
    <a href="mapa.php">
        <img src="images/images2/bernabeu.png" alt="">
    </a>
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
                    <h3>Valle</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas saepe illo ea sequi corporis,
                        cumque ipsum accusamus rem tempore impedit necessitatibus adipisci! Id et, mollitia nihil illum
                        commodi natus aut.</p>
                </div>

            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-data">2024</div>
                <div class="timeline-content">
                    <h3>camino del diablo</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas saepe illo ea sequi corporis,
                        cumque ipsum accusamus rem tempore impedit necessitatibus adipisci! Id et, mollitia nihil illum
                        commodi natus aut.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-data">2024</div>
                <div class="timeline-content">
                    <h3>12 de septiembre</h>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas saepe illo ea sequi
                            corporis,
                            cumque ipsum accusamus rem tempore impedit necessitatibus adipisci! Id et, mollitia nihil
                            illum
                            commodi natus aut.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-data">2024</div>
                <div class="timeline-content">
                    <h3>Otros</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas saepe illo ea sequi corporis,
                        cumque ipsum accusamus rem tempore impedit necessitatibus adipisci! Id et, mollitia nihil illum
                        commodi natus aut.</p>
                </div>
            </div>


        </div>
    </section>

    <section class="services" id="services">
        <h2 class="heading">Services</h2>

        <div class="services-container">
            <div class="service-box">
                <div class="service-info">
                    <h4>Arreindo</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quod qui nisi aut dolorem
                        voluptates totam aliquid blanditiis consectetur veniam aliquam, maiores in architecto, maxime
                        laudantium? Inventore consequatur sapiente aspernatur?</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Ventas</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quod qui nisi aut dolorem
                        voluptates totam aliquid blanditiis consectetur veniam aliquam, maiores in architecto, maxime
                        laudantium? Inventore consequatur sapiente aspernatur?</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>estacionamiento</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quod qui nisi aut dolorem
                        voluptates totam aliquid blanditiis consectetur veniam aliquam, maiores in architecto, maxime
                        laudantium? Inventore consequatur sapiente aspernatur?</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>arriendo de balon</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quod qui nisi aut dolorem
                        voluptates totam aliquid blanditiis consectetur veniam aliquam, maiores in architecto, maxime
                        laudantium? Inventore consequatur sapiente aspernatur?</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Forma de pago</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quod qui nisi aut dolorem
                        voluptates totam aliquid blanditiis consectetur veniam aliquam, maiores in architecto, maxime
                        laudantium? Inventore consequatur sapiente aspernatur?</p>
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
                    <input type ="text"
                    placeholder="Full Name">
                    <input type="email"
                    placeholder="Email">
                </div>
                <div class="input-box">
                    <input type="number"
                    placeholder="Phone Number">
                    <input type="text"
                    placeholder="Subject">
                </div>
            </div>

            <div class="input-group-2">
                <textarea name="" id="" cols="30" rows="10" 
                placeholder="Your Message"></textarea>
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