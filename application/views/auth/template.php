<!doctype html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&family=Pacifico&family=Roboto+Condensed:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="<?=base_url('dist/') ?>/plugins/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <style type="text/css">
        body{
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: 'Jost', sans-serif;
    background: linear-gradient(to bottom, #6D3202, #AB4F04, #6D3202);
}
.main{
    width: 350px;
    min-height: 330px;
    overflow: hidden;
    background-color: #AB4F04;
    border-radius: 10px;
    box-shadow: 5px 20px 50px #000;
    margin: 10px 10px;
}
#chk{
    display: none;
}
.signup{
    position: relative;
    width:100%;
    height: 100%;
}
label{
    color: #fff;
    font-size: 2.3em;
    justify-content: center;
    display: flex;
    margin: 30px;
    font-weight: bold;
    cursor: pointer;
    transition: .5s ease-in-out;
}
input[type=email], input[type=password], input[type=text], input[type=number]{
    width: 80%;
    height: 20px;
    background: #e0dede;
    justify-content: center;
    display: flex;
    margin: 20px auto;
    padding: 10px;
    border: none;
    outline: none;
    border-radius: 5px;
}
input[type=checkbox]{
    margin: 0 20px;
    
}
button{
    width: 85%;
    height: 40px;
    margin: 10px auto;
    justify-content: center;
    display: block;
    color: #fff;
    background: #6D3202;
    font-size: 1em;
    font-weight: bold;
    margin-top: 20px;
    outline: none;
    border: none;
    border-radius: 5px;
    transition: .2s ease-in;
    cursor: pointer;
}
button:hover{
    background: #291301;
}

#chk:checked ~ .signup label{
    transform: scale(.6);
}


    </style>
</head>
<body>
    <?= $contents ?>
</body>
</html>