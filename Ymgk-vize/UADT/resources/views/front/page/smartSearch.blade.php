@extends('front.layouts.master')
@section('content')
<style>
    header{
        background: #021130 !important;
    }
    .btn-primary {
        color: #fff;
        background-color: #021130 !important;
        border-color: #021130 !important;
    }

    .exportCategory {
        display:inline-block
    }

    .exportCountry{
        display:inline-block
    }

    .infoArea{
        display: none;
    }


</style>
<main id="main " class="smartMain">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href={{route('front.homePage')}}>Anasayfa</a></li>
                <li>İhracat Fırsatları</li>
            </ol>
            <h2>Günlük Dış Ticaret Verileriniz</h2>

        </div>
    </section><!-- End Breadcrumbs -->


    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <select onchange="smartSearch()" name="searchCategory" id="searchCategory" class="form-control form-control-lg">
                        <option value="{{null}}">Kategori:</option>
                        @foreach($categories as $category)
                        <option value="{{$category->name}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-4">
                    <select onchange="smartSearch()" name="searchCountry" id="searchCountry" class="form-control form-control-lg">
                        <option value="{{null}}" >Ülke:</option>
                        @foreach($countries as $country)
                            <option value="{{$country->country}}">{{$country->country}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="col-lg-12 col-md-12">
                    <i class="bi bi-search"></i>
                   <input onkeyup="smartSearch()" id="searchExport" class="form-control form-control-lg" type="search" placeholder="arama">
                </div>
            </div>
            <div class="row" style="margin-top: 2rem">
                <div class="section-title">
                    <p>Sonuçlar</p>
                </div>
            </div>
            <div class="row">
                @foreach($exports as $export)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="infoArea"><div class="exportCategory">{{ isset($export->getCategory) ? $export->getCategory->name : ''}}</div><div class="exportCountry">{{$export->country}}</div></div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$export->title}}</h5>
                                <p class="card-text">{{$export->description}}</p>
                                <a href="{{route('front.smartsearch.ihracatDetay',$export->id)}}" style="" class="btn btn-primary">Deyatları Gör</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section><!-- End Services Section -->

</main><!-- End #main -->
@endsection

@section('js')
    <script>
        smartSearch();
        function smartSearch(){
            let searchInput = document.getElementById('searchExport').value;
            let categoryInput = document.getElementById('searchCategory').value;
            let countryInput = document.getElementById('searchCountry').value

            let searchElement = document.querySelectorAll('.filter-card > .card > .card-body >.card-title');
            let categoryElement = document.querySelectorAll('.filter-card > .infoArea > .exportCategory');
            let countryElement = document.querySelectorAll('.filter-card > .infoArea > .exportCountry');

            let currentSearch;
            let currentCategory;
            let currentCountry;

            for (let i = 0 ; i < searchElement.length ; i++){
                currentSearch = searchElement[i].innerText;
                currentCategory = categoryElement[i].innerText;
                currentCountry = countryElement[i].innerText;

                if(searchInput !== '' && categoryInput !== '' && countryInput !== ''){//1
                    if(currentSearch.toUpperCase().indexOf(searchInput.toUpperCase()) === -1 || currentCategory.toUpperCase().indexOf(categoryInput.toUpperCase()) === -1 || currentCountry.toUpperCase().indexOf(countryInput.toUpperCase()) === -1 ){
                        categoryElement[i].parentElement.parentElement.style.display = "none";
                    }
                    else {
                        categoryElement[i].parentElement.parentElement.style.display = "block";
                    }
                }
                else if(searchInput !== '' && categoryInput !== '' && countryInput === ''){//2
                    if(currentSearch.toUpperCase().indexOf(searchInput.toUpperCase()) === -1 || currentCategory.toUpperCase().indexOf(categoryInput.toUpperCase()) === -1){
                        categoryElement[i].parentElement.parentElement.style.display = "none";
                    }
                    else {
                        categoryElement[i].parentElement.parentElement.style.display = "block";
                    }
                }
                else if(searchInput !== '' && categoryInput === '' && countryInput === ''){//3
                    if(currentSearch.toUpperCase().indexOf(searchInput.toUpperCase()) === -1){
                        categoryElement[i].parentElement.parentElement.style.display = "none";
                    }
                    else {
                        categoryElement[i].parentElement.parentElement.style.display = "block";
                    }
                }
                else if(searchInput === '' && categoryInput !== '' && countryInput !== ''){//4
                    if( currentCategory.toUpperCase().indexOf(categoryInput.toUpperCase()) === -1 || currentCountry.toUpperCase().indexOf(countryInput.toUpperCase()) === -1 ){
                        categoryElement[i].parentElement.parentElement.style.display = "none";
                    }
                    else {
                        categoryElement[i].parentElement.parentElement.style.display = "block";
                    }
                }
                else if(searchInput === '' && categoryInput === '' && countryInput !== ''){//5
                    if(currentCountry.toUpperCase().indexOf(countryInput.toUpperCase()) === -1 ){
                        categoryElement[i].parentElement.parentElement.style.display = "none";
                    }
                    else {
                        categoryElement[i].parentElement.parentElement.style.display = "block";
                    }
                }
                else if(searchInput !== '' && categoryInput === '' && countryInput !== ''){//6
                    if(currentSearch.toUpperCase().indexOf(searchInput.toUpperCase()) === -1 || currentCountry.toUpperCase().indexOf(countryInput.toUpperCase()) === -1 ){
                        categoryElement[i].parentElement.parentElement.style.display = "none";
                    }
                    else {
                        categoryElement[i].parentElement.parentElement.style.display = "block";
                    }
                }
                else if(searchInput === '' && categoryInput !== '' && countryInput === ''){//7
                    if(currentCategory.toUpperCase().indexOf(categoryInput.toUpperCase()) === -1){
                        categoryElement[i].parentElement.parentElement.style.display = "none";
                    }
                    else {
                        categoryElement[i].parentElement.parentElement.style.display = "block";
                    }
                }
                else if(searchInput === '' && categoryInput === '' && countryInput === ''){//8
                    categoryElement[i].parentElement.parentElement.style.display = "block";
                }


            }
        }
    </script>
@endsection


