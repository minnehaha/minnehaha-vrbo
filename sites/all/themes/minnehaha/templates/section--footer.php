<div class="container">
            <div class="row">
                <div class="span4">
                    <h2>Minnehaha<i>Lofts</i></h2>
                    <ul class="ml-foot">
                        <?php
                        foreach($seoref as $key => $ref){
                        print '<li><h1><a href="http://'.$ref['url'].'" target="_blank">'.$ref['keyword'].'</a></h1></li>';
 }?>
                    </ul>
                </div>
                <div class="span4">
                    <h2><i class="icon-globe icon-white jarak-kecil"></i>Social Networking</h2>
                    <p>
                        <i class="icon-twitter icon-white"></i> <a href="https://twitter.com/minnehahalofts" target="_blank">Follow Us on Twitter</a><i></i>
                    </p>
                    <p>
                        <i class="icon-fb icon-white"></i> <a href="http://www.facebook.com/minnehahalofts" target="_blank">MinnehahaLofts on Facebook</a>
                    </p>
                    <p>
                        <i class="icon-gp icon-white"></i> <a href="https://plus.google.com/u/0/b/100411277821392796298/100411277821392796298/posts" target="_blank">MinnehahaLofts on Google+</a>
                    </p>
                </div>
                <div class="span4">
                    <div id="inquiry-form-small">
                        <div class="message-section">
                            <div class="alert alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
                        </div>
                        <h2><i class="icon-envelope icon-white jarak-kecil"></i>Inquire</h2>
                        <p><textarea rows="3" id="inqContent" name="inqContent">Type your inquiry here.</textarea></p>
                        <div class="input-prepend">
                            <span class="add-on">E-Mail</span><input class="span2" id="userEmail" name="userEmail" size="16" type="text" >
                            <a class="btn btn-success" id="submitInq" href="#"><i class="icon-ok icon-white"></i>Inquire</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <footer><p>copyright <span class="minilogo">&nbsp;Minnehaha<i>Lofts</i></span> &copy; 2013. Created by : <a href="http://www.kapasoft.com">KapaSoft</a></p></footer>
</div>
