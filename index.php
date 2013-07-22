<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                
            });
        </script>
        <style type="text/css">
            #maindiv{
                width:1024px;
                height:720px;
                text-align: center;
            }
            .title{
                color:black;
                font-size:40pt;
            }
            .result{
                padding-top: 40px;
            }
        </style>
        <title>饭堂意见反馈</title>
    </head>
    <body style="background-color: #66ffff">
        <div id="maindiv">
            <div style="height:200px; line-height: 200px;"><img class="rice" src="img/rice.png"/><label class="title">饭堂意见反馈</label><a href="result.php"><img class="rice" src="img/rice.png"/></a></div>
        <form id="resultSubmit" action="submit.php" method="post">
            <input type="hidden" name="check_submit" value="1" />
            <input type="hidden" name="address" value="<?php echo $_SERVER['REMOTE_ADDR'];?>"/>
            <table style="width:100%;">
                <tr>
                    <td colspan="5">
                        <input type="radio" name="kitchen" value="1" checked="true" />饭堂(维修厂)
                        <input type="radio" name="kitchen" value="2" />饭堂(休息室)
                    </td>
                </tr>
                <tr>
                    <td class="result">
                        <img src="img/emo_vomit.png"/><br/>
                        很差<br/>
                        <input type="radio" name="result" value="0"/>
                    </td>
                    <td class="result">
                        <img src="img/emo_bad.png"/><br/>
                        不满意<br/>
                         <input type="radio" name="result" value="1"/>
                    </td>
                    <td class="result">
                        <img src="img/emo_soso.png"/><br/>
                        一般<br/>
                         <input type="radio" name="result" value="2"/>
                    </td>
                    <td class="result">
                        <img src="img/emo_accept.png"/><br/>
                        满意<br/>
                         <input type="radio" name="result" value="3"/>
                    </td>
                    <td class="result">
                        <img src="img/emo_great.png"/><br/>
                        非常满意<br/>
                        <input type="radio" name="result" value="4"/>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 50px;" colspan="5">
                        意见:<br/>
                        <textarea style="width: 500px;height:50px;" name="remark"></textarea> 
                        <br/>  
                        <br/>
                        <br/>
                        <input type="submit" name="提交"/>
                    </td>
                </tr>
            </table>
        </form>
         </div>
    </body>
</html>
