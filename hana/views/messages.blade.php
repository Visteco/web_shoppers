@extends('layouts.authorised')

@section('content')
<section class="profile-section">
    <div class="container-fluid">
        <div class="container no-gutter">
            <div class="row about_box">
                <div class="col-md-2">
                    <div class="row"> 
                        <div class="col-md-12 shadow_box filter">
                            <h5>Messaging<span class="icon-pencil2 pull-right"></span></h5>
                            <div class="col-lg-12 no-gutter"><input type="text" class="form-control" placeholder="Serch Keyword"></div>
                            <div class="col-lg-12 no-gutter table-responsive msgtbl">
                                <table class="table table-striped tbl_list">
                                    <tbody>
                                        <tr>
                                            <td><img src="images/people/p1.jpg" alt="...">
                                            </td>
                                            <td>
                                                <a href=""><div class="people_name">Ankur Sharma</div></a>
                                                <div class="people_des">Web Devloper (Php)</div>	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="images/people/p3.jpg" alt="..."></td>
                                            <td>
                                                <a href=""><div class="people_name">Abhishek Sharma</div></a>
                                                <div class="people_des">Web Devloper (Php)</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="images/people/p4.jpg" alt="..."></td>
                                            <td>
                                                <a href=""><div class="people_name">Vimal Kumar</div></a>
                                                <div class="people_des">Student</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="images/people/p5.jpg" alt="..."></td>
                                            <td>
                                                <a href=""><div class="people_name">Kanchan Gautam</div></a>
                                                <div class="people_des">Student</div>	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="images/people/p2.jpg" alt="..."></td>
                                            <td>
                                                <a href=""><div class="people_name">Nainsi Mehra</div></a>
                                                <div class="people_des">Student</div>	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="images/people/p1.jpg" alt="..."></td>
                                            <td>
                                                <a href=""><div class="people_name">Kalpana</div></a>
                                                <div class="people_des">Student</div>	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="images/people/p3.jpg" alt="..."></td>
                                            <td>
                                                <a href=""><div class="people_name">Prashant Tiwari</div></a>
                                                <div class="people_des">Student</div>	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="images/logos/1webcoir.png" alt="...">
                                            </td>
                                            <td>
                                                <a href=""><div class="comp_name">Webcoir It Solutions Pvt Ltd</div></a>
                                                <div class="comp_add">Noida, IN</div>	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://brandongaille.com/wp-content/uploads/2014/04/Google-Company-Logo.jpg" alt=""></td>
                                            <td>
                                                <a href=""><div class="comp_name">Google</div></a>
                                                <div class="comp_add">Chatham, UK</div>	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="http://www.creanara.com/uploads/ckeditor/6rebil280sg00g4sg.jpg" alt="..."></td>
                                            <td>
                                                <a href=""><div class="comp_name">Tata Consultency Services</div></a>
                                                <div class="comp_add">Noida, IN</div>	
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/TOSHIBA_Logo.png/375px-TOSHIBA_Logo.png" alt="..."></td>
                                            <td>
                                                <a href=""><div class="comp_name">Toshiba</div></a>
                                                <div class="comp_add">Chatham, UK</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="https://1.bp.blogspot.com/-Qjamw3erXas/V6DR7-mJalI/AAAAAAAAApM/WlQLYbO2I8sZLtQaEUTxZtucgmZhg6MjQCLcB/s1600/Citigroup-logo.jpg" alt="..."></td>
                                            <td>
                                                <a href=""><div class="comp_name">City Bank</div></a>
                                                <div class="comp_add">Noida, IN</div>	
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="col-lg-12 jobbox">
                        <div class="row">
                            <h5>New message</h5>
                            <input type="text" class="form-control" placeholder="Type a name or multiple names…" >
                            <div class="msgbody"> 
                                <div class="msgpanel"> 
                                    <div class="msg sentmsg">
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_sent">
                                                <p>hiiiii</p>
                                                <span>Sarvesh Kr. Yadav • 7months</span>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_11/medium/sarvesh.png" alt="User Avatar"> 
                                        </div>
                                    </div>
                                    <div class="msg recvmsg">
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_1/medium/590323369a3ed.jpg" alt="User Avatar"> 
                                        </div>
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_recv">
                                                <p>hrlo</p>
                                                <span>ankur sharma • 7months</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="msg sentmsg">
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_sent">
                                                <p>hiiiii</p>
                                                <span>Sarvesh Kr. Yadav • 7months</span>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_11/medium/sarvesh.png" alt="User Avatar"> 
                                        </div>
                                    </div>
                                    <div class="msg recvmsg">
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_1/medium/590323369a3ed.jpg" alt="User Avatar"> 
                                        </div>
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_recv">
                                                <p>hrlo</p>
                                                <span>ankur sharma • 7months</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="msg sentmsg">
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_sent">
                                                <p>hiiiii</p>
                                                <span>Sarvesh Kr. Yadav • 7months</span>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_11/medium/sarvesh.png" alt="User Avatar"> 
                                        </div>
                                    </div>
                                    <div class="msg recvmsg">
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_1/medium/590323369a3ed.jpg" alt="User Avatar"> 
                                        </div>
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_recv">
                                                <p>hrlo</p>
                                                <span>ankur sharma • 7months</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="msg sentmsg">
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_sent">
                                                <p>hiiiii</p>
                                                <span>Sarvesh Kr. Yadav • 7months</span>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_11/medium/sarvesh.png" alt="User Avatar"> 
                                        </div>
                                    </div>
                                    <div class="msg recvmsg">
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_1/medium/590323369a3ed.jpg" alt="User Avatar"> 
                                        </div>
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_recv">
                                                <p>hrlo</p>
                                                <span>ankur sharma • 7months</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="msg sentmsg">
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_sent">
                                                <p>hiiiii</p>
                                                <span>Sarvesh Kr. Yadav • 7months</span>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_11/medium/sarvesh.png" alt="User Avatar"> 
                                        </div>
                                    </div>
                                    <div class="msg recvmsg">
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_1/medium/590323369a3ed.jpg" alt="User Avatar"> 
                                        </div>
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_recv">
                                                <p>hrlo</p>
                                                <span>ankur sharma • 7months</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="msg sentmsg">
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_sent">
                                                <p>hiiiii</p>
                                                <span>Sarvesh Kr. Yadav • 7months</span>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_11/medium/sarvesh.png" alt="User Avatar"> 
                                        </div>
                                    </div>
                                    <div class="msg recvmsg">
                                        <div class="col-md-1 col-xs-1 avatar no-gutter"> 
                                            <img src="http://visteco.com/userimages/user_1/medium/590323369a3ed.jpg" alt="User Avatar"> 
                                        </div>
                                        <div class="col-md-11 col-xs-11 no-gutter">
                                            <div class="messages msg_recv">
                                                <p>hrlo</p>
                                                <span>ankur sharma • 7months</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="msgfooter">
                                <form class="msg_form" action="http://localhost/dev/sendmsg">          
                                    <p class="form-control msg_p" contenteditable="true" placeholder="Comment here" required="">
                                    </p>
                                </form>
                                <ul class="msgfooticon clearfix">
                                    <li><i class="glyphicon glyphicon-picture"></i><input type="file" name="pic" required=""></li>
                                    <li><i class="glyphicon glyphicon-facetime-video"></i><input type="file" name="vdo" required=""></li>
                                    <li><i class="glyphicon glyphicon-camera"></i><input type="file" name="camra" required=""></li>
                                    <li><i class="glyphicon glyphicon-paperclip"></i><input type="file" name="file" required=""></li>
                                    <li><button class="skybtn">Send</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>							
                </div>

                <div class="col-md-3">  
                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Hot Opportunities</h5>   
                            <img src="https://wallpaperscraft.com/image/alphabet_inc_google_holding_company_103920_602x339.jpg" width="100%">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 shadow_box">
                            <h5>Visteco Certified?</h5>
                            <p> Post your Visteco Credentials on Visteco Profile</p>
                            <button class="skybtn">Add to profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End sources Section -->
@endsection
