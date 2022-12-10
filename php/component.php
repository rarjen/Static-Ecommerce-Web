<?php
function component($productName, $productPrice, $productImg, $productId)
{
    $element = "
    <form action=\"index.php\" method=\"POST\">
        <div class=\"card\">
            <img src=\"$productImg\" alt=\"\">
            <h3>$productName</h3>
            <h4 class=\"stars\">
                <i class=\"fa-solid fa-star\"></i>
                <i class=\"fa-solid fa-star\"></i>
                <i class=\"fa-solid fa-star\"></i>
                <i class=\"fa-solid fa-star\"></i>
                <i class=\"fa-solid fa-star-half-stroke\"></i>
            </h4>
            <h4>IDR $productPrice</h4>
            <button type=\"submit\" name=\"add\">Add to cart <i class=\"fa-solid fa-cart-shopping\"></i></button>
            <input type=\"hidden\" name=\"product_id\" value=\"$productId\">
        </div>
    </form>
    ";
    echo $element;
}

function cart($productImg, $productName, $productPrice, $productId)
{

    $element = "
        <form action=\"cart.php?action=hapus&id=$productId\" method=\"POST\" class=\"cart-items\">
            <div class=\"border rounded\">
                <div class=\"row bg-white\">
                    <div class=\"col-md-3 pl-0\">
                        <img src=$productImg alt=\"\" class=\"img-fluid\">
                    </div>
                    <div class=\"col-md-6\">
                        <h5 class=\"pt-2\">$productName</h5>
                        <small class=\"text-secondary\">Seller: Otniel Book Shop</small>
                        <h5 class=\"pt-2\">$productPrice</h5>
                        <button type=\"submit\" class=\"btn btn-warning\">Wishtlist</button>
                        <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"hapus\">Hapus</button>
                    </div>
                    <div class=\"col-md-3 py-5\">
                        <div>
                            <form method=\"GET\">   
                                <input type=\"number\" value=\"1\" class=\"form-control p-2 w-25 d-inline\" name=\"qty\">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    ";



    echo $element;
}


function checkout($productImg, $productName, $productPrice, $productId)
{
    $element = "
        <form action=\"cart.php?action=hapus&id=$productId\" method=\"POST\" class=\"cart-items\">
            <div class=\"border rounded\">
                <div class=\"row bg-white\">
                    <div class=\"col-md-3 pl-0\">
                        <img src=$productImg alt=\"\" class=\"img-fluid\">
                    </div>
                    <div class=\"col-md-6\">
                        <h5 class=\"pt-2\">$productName</h5>
                        <small class=\"text-secondary\">Seller: Leinto</small>
                        <h5 class=\"pt-2\">$productPrice</h5>
                    </div>
                </div>
            </div>
        </form>
    ";

    echo $element;
}


// <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
//                             <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
//                             <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>