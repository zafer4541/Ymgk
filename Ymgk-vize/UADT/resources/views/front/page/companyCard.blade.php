<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Firma Kartı</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
<style>
    *{
        box-sizing: border-box;
    }
    p{
        text-shadow: 0 0 2px #0000004d;
        position: relative;
        z-index: 5;
    }
</style>
<div id="saveAsButtons" style="display: flex;margin-bottom:10px">
    <div style="margin: auto">
        <button onclick="saveProcess()" style="background-color: #021130;color:white;border-radius: 15px;width: 200px;height: 30px">PNG Olarak İndir</button>
        <button onclick="savePdf()" style="background-color: #021130;color:white;border-radius: 15px;width: 200px;height: 30px">PDF Olarak İndir</button>
    </div>
</div>
<div class="bordasdasder" id="cardBody" style="width: 100%; max-width: 700px; display: block; margin: auto; padding: 0 40px; background-color: #021130; position: relative;">
    <div style="padding: 15px; z-index: 66;">

    </div>
    <div style="padding: 60px 30px 30px 30px; background-color: white; position: relative; z-index: 5; display: flex; flex-wrap: wrap;">
        <img src="{{asset('front/accountCompanyCard/bdthm.png')}}" alt="" style="position: absolute; height: 100%; width: 100%; object-fit: cover; left: 0; z-index: 3; top: 0;">
        <div style="width: 175px; height: 175px; overflow: hidden; border-radius: 50%; float: left; margin-right: 25px; box-shadow: 0 0 14px 11px #0000001a;">
            <img src="{{asset('front/accountCompanyCard/companyLogo.jpeg')}}" alt="" style="width: 100%; height: 100%;  object-fit: cover; position: relative; z-index: 5; ">
        </div>
        <div style="width: calc(100% - 200px); height: 175px; display: flex; justify-content: center; flex-direction: column; margin-bottom: 60px;">
            <p style="margin: 10px 0; width: 100%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700;">Firmanın İsmi:</span> {{$user->company_name}}</p>
            <p style="margin: 10px 0; width: 100%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700;">Yetkili Adı Soyadı :</span> {{$user->name}}</p>
            <p style="margin: 10px 0; width: 100%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700;">E-mail Adersi:</span> {{$user->email}}</p>
            <p style="margin: 10px 0; width: 100%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700;">Kullanıcı Yetkisi:</span> Kullanıcı </p>
        </div>
        <p style="margin: 10px 0; width: 48%; margin-right: 2%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px; "><span style="font-weight: 700; display: block;">Firmanın Şehri:</span> {{$user->city}}</p>
        <p style="margin: 10px 0; width: 48%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px; "><span style="font-weight: 700; display: block;">Firmanın Telefonu:</span> {{$user->company_phone}}</p>
        <p style="margin: 10px 0; width: 48%; margin-right: 2%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px; "><span style="font-weight: 700; display: block;">Firmanın Faxı:</span> {{$user->company_fax}}</p>
        <p style="margin: 10px 0; width: 48%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px; "><span style="font-weight: 700; display: block;">Firmanın Ülkesi:</span> {{$user->country}}</p>
        <p style="margin: 10px 0; width: 48%; margin-right: 2%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Vergi Dairesi Ve Numarası:</span> {{$user->company_tax_administration}}</p>
        <p style="margin: 10px 0; width: 48%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Çalışan Kişi Sayısı:</span> {{$user->company_number_employees}} </p>
        <p style="margin: 10px 0; width: 48%; margin-right: 2%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Sermayesi(TL):</span> {{$user->company_capital}} TL</p>
        <p style="margin: 10px 0; width: 48%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Kuruluşu:</span> {{$user->company_foundation_year}}</p>
        <p style="margin: 10px 0; width: 48%; margin-right: 2%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Sahip Olduğu Kapalı Alan(m2):</span> {{$user->company_closed_area}} m2</p>
        <p style="margin: 10px 0; width: 48%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Türü:</span>Yazılım </p>
        <p style="margin: 10px 0; width: 48%; margin-right: 2%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Sahip Olduğu Açık Alan(m2):</span> {{$user->company_open_area}} m2</p>
        <p style="margin: 10px 0; width: 48%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Adresi:</span> {{$user->company_address}}</p>
        <p style="margin: 10px 0; width: 100%; height: max-content; font-family: 'Jost', sans-serif; font-size: 17px;"><span style="font-weight: 700; display: block;">Firmanın Açıklaması:</span> {{$user->company_description}}</p>
        <div style="width: 100%; display: flex; margin: 40px 0;">
            <a id="siteUrl" href="{{route('front.account.companyCardIndex')}}" style="font-family: 'Jost', sans-serif;  margin: auto; text-decoration: none;padding: 7px 25px; background-color: #021130; box-sizing: border-box; border-radius: 10px; color: white;z-index: 99">Siteye Git</a>
        </div>
    </div>

    <div style="display: flex; justify-content: center; align-items: center; padding: 15px ;">
        <div id="socialMediaIcon">
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://"> <img src="{{asset('front/accountCompanyCard/facebook.png')}}" alt="" style="width: 30px; height: 30px; margin-right: 10px;"></a>
            <a href="https://twitter.com/intent/tweet?url=https://"> <img src="{{asset('front/accountCompanyCard/twitter.png')}}" alt="" style="width: 30px; height: 30px; margin-right: 10px;"></a>
            <a href="https://www.linkedin.com/cws/share/?url=https://"> <img src="{{asset('front/accountCompanyCard/instagram.png')}}" alt="" style="width: 30px; height: 30px; margin-right: 10px;"></a>
        </div>
    </div>
</div>
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<script>
    function savePdf(){
        document.getElementById('siteUrl').href = window.location;
        document.getElementById('saveAsButtons').style.display = "none";
        document.getElementById('socialMediaIcon').style.display = "none";
        window.print();
        document.getElementById('saveAsButtons').style.display = "flex";
        document.getElementById('socialMediaIcon').style.display = "flex";
    }


    function saveProcess(){
        document.getElementById('siteUrl').style.display = "none";
        html2canvas(document.getElementById('cardBody')).then(function(canvas) {
            saveAs(canvas.toDataURL(), '{{$user->name}}-card.png');
        });
    }

    function saveAs(uri, filename) {

        var link = document.createElement('a');

        if (typeof link.download === 'string') {

            link.href = uri;
            link.download = filename;

            //Firefox requires the link to be in the body
            document.body.appendChild(link);

            //simulate click
            link.click();

            //remove the link when done
            document.body.removeChild(link);

        } else {

            window.open(uri);

        }

        document.getElementById('siteUrl').style.display = "block";
    }
</script>

</body>
</html>
