<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <style>
        /* Reset some default browser styles */
        

        /* Footer Styles */
        .footer {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .footer-section {
            flex: 1;
            padding: 1rem;
        }

        .footer-section h2 {
            margin-bottom: 1rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul li a {
            color: #fff;
            text-decoration: none;
        }

        .footer-section p {
            margin: 0.5rem 0;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
            }

            .footer-section {
                margin-bottom: 1rem;
            }
        }
    </style>
    <script>
        function loadGoogleTranslate() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,gu' // English and Gujarati
            }, 'google_element');
        }

        function saveSelectedLanguage() {
            const select = document.querySelector('.goog-te-combo');
            if (select) {
                select.addEventListener('change', () => {
                    const selectedLanguage = select.value;
                    localStorage.setItem('selectedLanguage', selectedLanguage);
                });
            }
        }

        function initTranslate() {
            loadGoogleTranslate();
            setTimeout(saveSelectedLanguage, 1000); // Ensure the select element is available
        }
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=initTranslate" async defer></script>
    
</head>

<body>
    <main>
        <!-- Main content here -->
    </main>
    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>About Us</h2>
                <p>Welcome to Satadiya Village, where tradition meets tranquility.</p>
            </div>
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <ul>
                
                    <li><a href='/project24'>Home</a></li>
                   
                   <li><a  href='http://localhost/project24/history.php'>About Us</a></li> 
                    <li><a  href='http://localhost/project24/gallery.php'>Gallery</a></li>
                  
                </ul>
            </div>
            <div class="footer-section contact">
                <h2>Contact Us</h2>
                <p>Email: satadiya.in@gmail.com</p>
                <p>Phone: (2634) 296932 </p>
            </div>
            <div class="footer-section translate">
                <h2>Translate</h2>
                <div id="google_element"></div>
            </div>
        </div>
    </footer>
</body>

</html>
