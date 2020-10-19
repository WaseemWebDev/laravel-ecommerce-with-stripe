<nav class="navbar navbar-expand-sm bg-primary navbar-dark" style="width:100%">
    <!-- Brand -->
    <a class="navbar-brand" href="/">Ecommerce</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/createproduct">create product</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
                <a class="nav-link " href="/viewcart"><i style="font-size:40px;color:white" class="fas fa-cart-plus"></i> <span class="badge badge-pill badge-dark">{{Cart::getContent()->count()}}</span></a>
            </li>
        </ul>
    </div>
</nav>
