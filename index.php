<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Database</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header>
    <div class="logo"><a href="#"><img src="assests/Logo.png" alt="Logo"></a></div>
    <nav>
        <ul id="menu">
            <li><a href="#home">HOME</a></li>
            <li><a href="#ourscreens">OUR SCREENS</a></li>
            <li><a href="#shedule">SHEDULE</a></li>
            <li><a href="#movielibrary">MOVIE LIBRARY</a></li>
            <li><a href="#location&contact">LOCATION & CONTACT</a></li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">☰</div>
    </nav>
</header>

<section id="main-visual">
    <img src="assests/banner.png" alt="Main Image">
</section>

<section id="intro">
    <h2>MOVIE LIBRARY</h2>
    <p class="small-box">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam volup.</p>

</section>

<section id="favorites-section">
    <div class="container">
        <div class="header">
            <h2 class="section-title">Collect your favourites</h2>
            <input type="text" id="movie-search" placeholder="Search title and add to grid" class="search-bar">
        </div>
        <hr class="divider-line">
        <br><br>
        <div id="movie-container" class="movie-grid"></div>
    </div>
</section>

<h2>How to reach Us</h2>
<p>Lorem ipsum dolor sit amet, consetetur</p>
<section id="contact">
    <form id="contact-form" action="contact_form_handler.php" method="POST">
        <div class="form-row">
            <div class="form-group form-row-group">
                <div class="form-column">
                    <label for="first-name">First Name *</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div class="form-column">
                    <label for="last-name">Last Name *</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Telephone</label>
            <input type="tel" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message"></textarea>
        </div>

        <p class="required-note">*required fields</p>
        <div class="terms">
            <input type="checkbox" id="terms" name="terms">
            <label for="terms">I agree to the <a href="#">Terms & Conditions</a></label>
        </div>
        <button type="submit" class="submit-btn" style="background-color: yellow; color: black; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer;">SUBMIT</button>

    </form>

    <div id="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.828253820474!2d79.86844057585396!3d6.927078394987866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259260b72cbf3%3A0x1e8b33406c460c94!2seBEYONDS!5e0!3m2!1sen!2slk!4v1685799609120!5m2!1sen!2slk"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

<footer id="footer">
    <div class="footer-content">
        <div class="footer-address">
            <h3>IT Group</h3>
            <p>
                C. Salvador de Madariaga, 1<br>
                28027 Madrid<br>
                Spain
            </p>
        </div>

        <div class="footer-social">
            <p>Follow us on<a href="#" aria-label="Twitter">
                <img src="assests/twitter.png" alt="Twitter" />
            </a>
            <a href="#" aria-label="YouTube">
                <img src="assests/youtube.png" alt="YouTube" />
            </a></p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>Copyright © 2022 IT Group. All rights reserved.</p>
        <p>
            Photos by <a href="#">Felix Mooneeram</a> & <a href="#">Serge Kutuzov</a> on
            <a href="#">Unsplash</a>
        </p>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const episodesContainer = document.getElementById('movie-container');
        const searchInput = document.getElementById('movie-search');

        const fetchEpisodes = (url) => {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    episodesContainer.innerHTML = '';
                    if (data.length === 0) {
                        episodesContainer.innerHTML = '<p>No results found</p>';
                    } else {
                        data.forEach(item => {
                            const episode = item.show || item;
                            const movieCardDiv = document.createElement('div');
                            movieCardDiv.classList.add('movie-card');

                            movieCardDiv.innerHTML = `
                                <img src="${episode.image ? episode.image.medium : ''}" alt="${episode.name}" class='movie-img'>
                                <div class="movie-info">
                                    <h3>${episode.name}</h3>
                                    <p>${episode.summary}</p>
                                </div>`;

                            episodesContainer.appendChild(movieCardDiv);
                        });
                    }
                })
                .catch(error => console.error('Error fetching episodes:', error));
        };

        
        fetchEpisodes('https://api.tvmaze.com/shows/1/episodes');

       
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.trim();
            if (query) {
                fetchEpisodes(`https://api.tvmaze.com/search/shows?q=${query}`);
            } else {
                fetchEpisodes('https://api.tvmaze.com/shows/1/episodes');
            }
        });
    });
</script>
<script src="scripts.js"></script>
</body>
</html>
