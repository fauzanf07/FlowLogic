<!DOCTYPE html>
<html>
<body>

    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function(){
        $("button").click(function(){

		    const settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://code-compiler.p.rapidapi.com/v2",
                "method": "POST",
                "headers": {
                    "content-type": "application/x-www-form-urlencoded",
                    "X-RapidAPI-Key": "7551b4305bmsh6ab4e93884d4a74p152950jsn675a3dc36544",
                    "X-RapidAPI-Host": "code-compiler.p.rapidapi.com"
                },
                "data": {
                    "LanguageChoice": "5",
                    "Program": $('#code').val(),
                }
            };
            
            $.ajax(settings).done(function (response) {
                alert(response.Result);
            });
	    });
    });
    </script>
    </head>

    <textarea id="code">
        using System;
        using System.Collections.Generic;
        using System.Linq;
        using System.Text.RegularExpressions;

        namespace Rextester
        {
            public class Program
            {
                public static void Main(string[] args)
                {
                    //Your code goes here
                    Console.WriteLine("Hello, world!");
                }
            }
        }      
    </textarea>
    <button id="run">Run</button>

</body>
</html>