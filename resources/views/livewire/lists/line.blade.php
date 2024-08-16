<div>
    <div class="row">
        @foreach($items as $item)
        <div class="col-12 list" data-check-all="checkAll">
            <div class="card d-flex flex-row mb-3 active">
                <div class="d-flex flex-grow-1 min-width-zero">
                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                        <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="Pages.Product.Detail.html">
                            Marble Cake
                        </a>
                        <p class="mb-0 text-muted text-small w-15 w-xs-100">Cakes</p>
                        <p class="mb-0 text-muted text-small w-15 w-xs-100">02.04.2018</p>
                        <div class="w-15 w-xs-100">
                            <span class="badge badge-pill badge-secondary">ON HOLD</span>
                        </div>
                    </div>
                    <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-label">&nbsp;</span>
                    </label>
                </div>
            </div>
            @endforeach


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