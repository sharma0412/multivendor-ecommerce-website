@extends('Frontend.utils.master')

@section('content')
<div class="page-content">
    <div class="breadcrumb-div bg-theme">
        <div class="container">
            <ul class="breadcrumb-custom mb-0 bg-none">
                <li><a href="http://127.0.0.1:8000">Home</a></li>
                <li class="on">My List</li>
            </ul>
        </div>
    </div>
    <!---End-->
    <div class="list_product_show space-6">
        <div class="container">
            <div class="mx-auto col-md-12 col-xl-10 col-lg-12">
                <div class="two_divider_column">
                    <div class="d-flex flex-wrap">
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-0 px-md-4 border-right-show position-relative">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="heading-other f-20">My List</h5>
                                <a href="" class="btn-blue bg-theme text-decoration-none" data-toggle="modal"
                                    data-target="#addproducts"><i class="fas fa-plus"></i> Add Products</a>
                            </div>
                            <ul class="list-unstyled mt-5 disc-list-brocoli">
                                <li class="line-colum-delet mb-3 active">
                                    <div class="d-flex justify-content-between">
                                        <div class="right-data">
                                            <h6 class="mb-1">Broccoli</h6>
                                            <p class="mb-0 f-12">Amazon</p>
                                        </div>
                                        <div class="trash-alt">
                                            <i class="fas fa-trash-alt"></i>
                                        </div>
                                    </div>
                                </li>
                                <!-- End -->
                                <li class="line-colum-delet mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="right-data">
                                            <h6 class="mb-1">Broccoli</h6>
                                            <p class="mb-0 f-12">Amazon</p>
                                        </div>
                                        <div class="trash-alt">
                                            <i class="fas fa-trash-alt"></i>
                                        </div>
                                    </div>
                                </li>
                                <!-- End -->
                                <li class="line-colum-delet mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="right-data">
                                            <h6 class="mb-1">Broccoli</h6>
                                            <p class="mb-0 f-12">Amazon</p>
                                        </div>
                                        <div class="trash-alt">
                                            <i class="fas fa-trash-alt"></i>
                                        </div>
                                    </div>
                                </li>
                                <!-- End -->
                                <li class="line-colum-delet mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="right-data">
                                            <h6 class="mb-1">Broccoli</h6>
                                            <p class="mb-0 f-12">Amazon</p>
                                        </div>
                                        <div class="trash-alt">
                                            <i class="fas fa-trash-alt"></i>
                                        </div>
                                    </div>
                                </li>
                                <!-- End -->
                                <li class="line-colum-delet mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="right-data">
                                            <h6 class="mb-1">Broccoli</h6>
                                            <p class="mb-0 f-12">Amazon</p>
                                        </div>
                                        <div class="trash-alt">
                                            <i class="fas fa-trash-alt"></i>
                                        </div>
                                    </div>
                                </li>
                                <!-- End -->
                            </ul>
                        </div>
                        <!-- End -->
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-0 px-md-4">
                            <div class="offer-show">
                                <h5 class="heading-other f-20">Offer</h5>
                                <ul class="list-unstyled mt-4">
                                    <li class="offer-list mb-3 border-bottom-line">
                                        <div class="d-flex justify-content-between">
                                            <div class="right-data">
                                                <h6 class="mb-1">Broccoli</h6>
                                                <p class="mb-0 f-12">Amazon</p>
                                            </div>
                                            <div class="trash-alt">
                                                <h6 class="mb-0"><b>4kg</b></h6>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- End -->
                            <div class="all-offer-showing">
                                <h5 class="heading-other">All Offers(456)</h5>
                                <div class="list-scroll-offer">
                                    <div class="amazone-list">
                                        <p class="color-light">AMAZON</p>
                                        <ul class="list-unstyled mt-4">
                                            <li class="offer-list mb-3 border-bottom-line">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="right-data">
                                                        <h6 class="mb-1">20% off</h6>
                                                        <p class="mb-0 f-12">Amazon</p>
                                                    </div>
                                                    <div class="trash-alt">
                                                        <a href="" class="btn-blue bg-theme text-decoration-none"> Add
                                                            To
                                                            Cart</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End-->
                                            <li class="offer-list mb-3 border-bottom-line">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="right-data">
                                                        <h6 class="mb-1">20% off</h6>
                                                        <p class="mb-0 f-12">Amazon</p>
                                                    </div>
                                                    <div class="trash-alt">
                                                        <a href="" class="btn-blue bg-theme text-decoration-none"> Add
                                                            To
                                                            Cart</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End-->
                                            <li class="offer-list mb-3 border-bottom-line">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="right-data">
                                                        <h6 class="mb-1">20% off</h6>
                                                        <p class="mb-0 f-12">Amazon</p>
                                                    </div>
                                                    <div class="trash-alt">
                                                        <a href="" class="btn-blue bg-theme text-decoration-none"> Add
                                                            To
                                                            Cart</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End-->
                                        </ul>
                                    </div>
                                    <!--End-->
                                    <div class="amazone-list">
                                        <p class="color-light">FLIPKART</p>
                                        <ul class="list-unstyled mt-4">
                                            <li class="offer-list mb-3 border-bottom-line">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="right-data">
                                                        <h6 class="mb-1">20% off</h6>
                                                        <p class="mb-0 f-12">Amazon</p>
                                                    </div>
                                                    <div class="trash-alt">
                                                        <a href="" class="btn-blue bg-theme text-decoration-none"> Add
                                                            To
                                                            Cart</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End-->
                                            <li class="offer-list mb-3 border-bottom-line">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="right-data">
                                                        <h6 class="mb-1">20% off</h6>
                                                        <p class="mb-0 f-12">Amazon</p>
                                                    </div>
                                                    <div class="trash-alt">
                                                        <a href="" class="btn-blue bg-theme text-decoration-none"> Add
                                                            To
                                                            Cart</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End-->
                                            <li class="offer-list mb-3 border-bottom-line">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="right-data">
                                                        <h6 class="mb-1">20% off</h6>
                                                        <p class="mb-0 f-12">Amazon</p>
                                                    </div>
                                                    <div class="trash-alt">
                                                        <a href="" class="btn-blue bg-theme text-decoration-none"> Add
                                                            To
                                                            Cart</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--End-->
                                        </ul>
                                    </div>
                                    <!--End-->
                                </div>
                                <!-- End -->
                            </div>
                            <!-- End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End -->
    </div>
    <!-- Modal -->
    <div class="modal fade add-product-modal" id="addproducts" tabindex="-1" role="dialog"
        aria-labelledby="addproductsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-sm radius-20">
                <div class="modal-body p-0 position-relative">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="padding-box-data">
                        <form>
                            <div class="input-block">
                                <input class="input-field" type="text" name="" placeholder="Type Product Name">
                            </div>
                            <div class="input-block">
                                <select class="category-list form-control nice-select">
                                    <option>category</option>
                                    <option>category</option>
                                    <option>category</option>
                                </select>
                            </div>
                            <div class="input-block">
                                <input class="input-field" type="" name="" placeholder="Quantity">
                            </div>
                            <button type="submit" class="bg-theme submit-btn">Add Product</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
    @endsection