<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background: rgb(204,204,204); 
        }
        .bgimg {
            background-image: url('/res/assets_themes/theme1.jpg') !important;
            -webkit-print-color-adjust: exact; 
            height: 100%;
            background-position: center;
            background-size: cover;
            position: relative;
            color: white;
            font-family: "Courier New", Courier, monospace;
            font-size: 20px;
        }
        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        @media print {
            body, page[size="A4"] {
                margin: 0;
                box-shadow: 0;
            }
        }
        
        .qrcode img{
            margin: auto;
            width: 50%;
            padding-top: 360px;
        }
    </style>
</head>
<body>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <page size="A4">
        <div class="bgimg">
            <div class="middle">
              <div id="qrcode" class="qrcode"></div>
              <input type="hidden" id="uuid" value="{{ URL::to('rate?id='.$uuid) }}">
            </div>
        </div>
    </page>

    <script>
        let website = document.getElementById('uuid').value;
        if (website) {
            let qrcodeContainer = document.getElementById("qrcode");
            qrcodeContainer.innerHTML = "";
            new QRCode(qrcodeContainer, website);
        } else {
            alert("Please enter a valid URL");
        }
    
        var css = '@page { size: potrait; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');
    
        style.type = 'text/css';
        style.media = 'print';
    
        if (style.styleSheet){
        style.styleSheet.cssText = css;
        } else {
        style.appendChild(document.createTextNode(css));
        }
    
        head.appendChild(style);
    
        window.print();
    </script>
</body>
</html>