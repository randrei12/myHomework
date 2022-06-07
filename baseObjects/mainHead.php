<!-- A se pune chiar dupa secitunea <head> -->

    <title>myHomework</title>
    <meta charset="UTF-8">
    <meta name="description" content="myHomework">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="icon" type="image/ico" href="/assests/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
    <script src="/baseObjects/limba/limbi.js" defer></script>
    <script>
        //din cauza tastaturii la telefoane, height-ul elementelor (care folosesc vh sau %) se schimba. Noi nu ne dorim acest lucru
        var viewport = document.querySelector("meta[name=viewport]");
        viewport.setAttribute("content", viewport.content + ", height=" + window.innerHeight);
    </script>