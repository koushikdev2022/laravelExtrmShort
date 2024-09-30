@extends('layouts.master')
@section('content')
<div class="clearfix">
    <div class="dash-bottom-part pb-0">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="frame">
                    <div id="sidepanel" class="sidepanel">
                        <div id="search">
                            <label><i class="fa fa-search" aria-hidden="true"></i></label>
                            <input type="text" placeholder="Search for people" />
                        </div>
                        <div id="contacts" class="chat_list contacts">
                            <ul>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status online"></span>
                                        <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Louis Litt <span class="date">Apr 20</span></p>
                                            <p class="preview">You just got LITT up, Mike.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact active">
                                    <div class="wrap">
                                        <span class="contact-status busy"></span>
                                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Harvey Specter <span class="date">Apr 20</span></p>
                                            <p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status away"></span>
                                        <img src="http://emilcarlsson.se/assets/rachelzane.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Rachel Zane <span class="date">Apr 20</span></p>
                                            <p class="preview">I was thinking that we could have chicken tonight, sounds good?</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status online"></span>
                                        <img src="http://emilcarlsson.se/assets/donnapaulsen.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Donna Paulsen <span class="date">Apr 20</span></p>
                                            <p class="preview">Mike, I know everything! I'm Donna..</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status busy"></span>
                                        <img src="http://emilcarlsson.se/assets/jessicapearson.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Jessica Pearson <span class="date">Apr 20</span></p>
                                            <p class="preview">Have you finished the draft on the Hinsenburg deal?</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status"></span>
                                        <img src="http://emilcarlsson.se/assets/haroldgunderson.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Harold Gunderson <span class="date">Apr 20</span></p>
                                            <p class="preview">Thanks Mike! :)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status"></span>
                                        <img src="http://emilcarlsson.se/assets/danielhardman.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Daniel Hardman <span class="date">Apr 20</span></p>
                                            <p class="preview">We'll meet again, Mike. Tell Jessica I said 'Hi'.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status busy"></span>
                                        <img src="http://emilcarlsson.se/assets/katrinabennett.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Katrina Bennett <span class="date">Apr 20</span></p>
                                            <p class="preview">I've sent you the files for the Garrett trial.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status"></span>
                                        <img src="http://emilcarlsson.se/assets/charlesforstman.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Charles Forstman <span class="date">Apr 20</span></p>
                                            <p class="preview">Mike, this isn't over.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="contact">
                                    <div class="wrap">
                                        <span class="contact-status"></span>
                                        <img src="http://emilcarlsson.se/assets/jonathansidwell.png" alt="" />
                                        <div class="meta">
                                            <p class="name">Jonathan Sidwell <span class="date">Apr 20</span></p>
                                            <p class="preview"><span>You:</span> That's bullshit. This deal is solid.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--                                    <div id="bottom-bar">
                                                                                        <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
                                                                                        <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
                                                                                    </div>-->
                    </div>
                    <div class="content">
                        <div class="contact-profile">
                            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                            <p>Harvey Specter</p>
                            <div class="social-media camera">
                                <a href="#" class="common-btn">
                                    View Profile
                                </a>
                            </div>
                        </div>
                        <div class="messages">
                            <ul>
                                <li class="sent">
                                    <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                                    <p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
                                    <span class="msg_time">8:40 AM, Today</span>
                                    <div class="social-media dmenu dropdown camera ml-auto">
                                        <a class="nav-link dropdown-toggle video_call spldrpat" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right cmndrpbx sm-menu" aria-labelledby="navbarDropdown">
                                            <div class="menu_dflex">
                                                <div class="right_link">
                                                    <a class="dropdown-item" href="#"><i class="icofont-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="replies">
                                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                                    <p>When you're backed against the wall, break the god damn thing down.</p>
                                    <span class="msg_time">8:40 AM, Today</span>
                                    <div class="social-media dmenu dropdown camera mr-auto">
                                        <a class="nav-link dropdown-toggle video_call spldrpat" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right cmndrpbx sm-menu" aria-labelledby="navbarDropdown">
                                            <div class="menu_dflex">
                                                <div class="right_link">
                                                    <a class="dropdown-item" href="#"><i class="icofont-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="replies">
                                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                                    <p>Excuses don't win championships.</p>
                                    <span class="msg_time">8:40 AM, Today</span>
                                    <div class="social-media dmenu dropdown camera mr-auto">
                                        <a class="nav-link dropdown-toggle video_call spldrpat" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right cmndrpbx sm-menu" aria-labelledby="navbarDropdown">
                                            <div class="menu_dflex">
                                                <div class="right_link">
                                                    <a class="dropdown-item" href="#"><i class="icofont-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="sent">
                                    <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                                    <p>Oh yeah, did Michael Jordan tell you that?</p>
                                    <span class="msg_time">8:40 AM, Today</span>
                                    <div class="social-media dmenu dropdown camera ml-auto">
                                        <a class="nav-link dropdown-toggle video_call spldrpat" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right cmndrpbx sm-menu" aria-labelledby="navbarDropdown">
                                            <div class="menu_dflex">
                                                <div class="right_link">
                                                    <a class="dropdown-item" href="#"><i class="icofont-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="replies">
                                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                                    <p>No, I told him that.</p>
                                    <span class="msg_time">8:40 AM, Today</span>
                                    <div class="social-media dmenu dropdown camera mr-auto">
                                        <a class="nav-link dropdown-toggle video_call spldrpat" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right cmndrpbx sm-menu" aria-labelledby="navbarDropdown">
                                            <div class="menu_dflex">
                                                <div class="right_link">
                                                    <a class="dropdown-item" href="#"><i class="icofont-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="replies">
                                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                                    <p>What are your choices when someone puts a gun to your head?</p>
                                    <span class="msg_time">8:40 AM, Today</span>
                                    <div class="social-media dmenu dropdown camera mr-auto">
                                        <a class="nav-link dropdown-toggle video_call spldrpat" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right cmndrpbx sm-menu" aria-labelledby="navbarDropdown">
                                            <div class="menu_dflex">
                                                <div class="right_link">
                                                    <a class="dropdown-item" href="#"><i class="icofont-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="sent">
                                    <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                                    <p>What are you talking about? You do what they say or they shoot you.</p>
                                    <span class="msg_time">8:40 AM, Today</span>
                                    <div class="social-media dmenu dropdown camera ml-auto">
                                        <a class="nav-link dropdown-toggle video_call spldrpat" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right cmndrpbx sm-menu" aria-labelledby="navbarDropdown">
                                            <div class="menu_dflex">
                                                <div class="right_link">
                                                    <a class="dropdown-item" href="#"><i class="icofont-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="replies">
                                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                                    <p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
                                    <span class="msg_time">8:40 AM, Today</span>
                                    <div class="social-media dmenu dropdown camera mr-auto">
                                        <a class="nav-link dropdown-toggle video_call spldrpat" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right cmndrpbx sm-menu" aria-labelledby="navbarDropdown">
                                            <div class="menu_dflex">
                                                <div class="right_link">
                                                    <a class="dropdown-item" href="#"><i class="icofont-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="message-input">
                            <div class="wrap">
                                <input type="text" placeholder="Write your message..." />
                                <i class="icofont-simple-smile attacharea messageicon"></i>
                                <i class="fa fa-paperclip attachment messageicon" aria-hidden="true"></i>
                                <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop
