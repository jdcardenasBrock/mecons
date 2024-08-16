<div>
    <div class="row list disable-text-selection" data-check-all="checkAll">
        @foreach($items as $item)
        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-4">
            <div class="card active">
                <div class="position-relative">
                    <a href="Pages.Product.Detail.html"><img class="card-img-top" src="img/cards/thumb-1.jpg" alt="Card image cap"></a>
                    <span class="badge badge-pill badge-theme-1 position-absolute badge-top-left">NEW</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <div class="custom-control custom-checkbox pl-1">
                                <label class="custom-control custom-checkbox  mb-0">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-10">
                            <a href="Pages.Product.Detail.html">
                                <p class="list-item-heading mb-4 pt-1">Cheesecake</p>
                            </a>
                            <footer>
                                <p class="text-muted text-small mb-0 font-weight-light">18.08.2018</p>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12">
            <nav class="mt-4 mb-3">
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item ">
                        <a class="page-link first" href="#">
                            <i class="simple-icon-control-start"></i>
                        </a>
                    </li>
                    <li class="page-item ">
                        <a class="page-link prev" href="#">
                            <i class="simple-icon-arrow-left"></i>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item ">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item ">
                        <a class="page-link next" href="#" aria-label="Next">
                            <i class="simple-icon-arrow-right"></i>
                        </a>
                    </li>
                    <li class="page-item ">
                        <a class="page-link last" href="#">
                            <i class="simple-icon-control-end"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>