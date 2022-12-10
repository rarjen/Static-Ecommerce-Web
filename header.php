<?php
function navbar()
{
    $element = "
        <div class=\"navbar\">
            <div class=\"navbarcontent\">
                <div class=\"user thin\">
                    <ul>
                        <li><a href=\"\"><i class=\"fa-solid fa-location-dot\"></i><span> </span>Address123, City, Country </a></li>
                        <li>|</li>
                        <li><a href=\"\"><i class=\"fa-solid fa-envelope\"></i><span> </span>someaddress@example.com </a></li>
                        <li>|</li>
                        <li><a href=\"\"><i class=\"fa-solid fa-phone\"></i><span> </span>+123(456)6784812</a></li>
                    </ul>
                </div>
                <div class=\"account thin\">
                    <ul>
                        <li><a href=\"login.html\"><i class=\"fa-solid fa-user\"></i><span> </span>MY ACCOUNT</a></li>
                        <li><a href=\"#\"><i class=\"fa-solid fa-heart\"></i><span> </span>WISHLIST</a></li>
                        <li><a href=\"#\"><i class=\"fa-brands fa-facebook-f\"></i></a></li>
                        <li><a href=\"#\"><i class=\"fa-brands fa-twitter\"></i></a></li>
                        <li><a href=\"#\"><i class=\"fa-brands fa-instagram\"></i></a></li>
                        <li><a href=\"#\"><i class=\"fa-brands fa-google-plus-g\"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    ";
    echo $element;
}
