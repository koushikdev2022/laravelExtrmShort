@extends('layouts.master')
@section('content')
    <!--HERO SECTION START-->
    <section class="hero-section">

        <figure>
            <!--            <img src="{{ URL::asset('public/frontend/images/hero-banner.jpg') }}" alt="hero-banner"/>-->
            <video autoplay muted loop>
                <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </figure>
        <div class="hero-cont container">
            <div class="hero-cont-inner">
                <h2>Xtreme long shot</h2>
                <p>Your BIG SHOT is here!</p>
                <form class="search-form" action="{{ Route('listing') }}">
                    <input type="search" name="search" placeholder="What are you looking for" />
                    <input type="submit" value="search" />
                </form>
                <ul class="trending-keywords">
                    <li>Trending Keywords:</li>
                    <li><a href="#">city</a></li>
                    <li><a href="#">sport</a></li>
                    <li><a href="#">tourism</a></li>
                    <li><a href="#">war</a></li>
                    <li><a href="#">cars</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!--HERO SECTION END-->
    @if(count($data) > 0)
    <div class="container">
        <div class="pop-wrappermain">

            <div class="section-heading text-center">
                <h3 class="heading">Short Videos</h3>
            </div>
            {{-- <div class="pop-wrapper flex-container">
                <div class="owl-carousel shortvideo">
                    <div class="item">
                        <span class="pop flex-container">
                            <a href="javascript:void(0)" id="stories">
                                <div class="pop-img-container">

                                    <img src="https://images.unsplash.com/photo-1488161628813-04466f872be2?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=764&amp;q=80"
                                        alt="" class="pop-img">
                                </div>
                                <p class="pop-text">Lorem Ipsum</p>
                            </a>
                        </span>
                    </div>
                </div>
            </div> --}}


            <div class="pop-wrapper flex-container">
                <div id="stories" class="storiesWrapper"></div>

            </div>
        </div>
    </div>
    @endif

    <!--POPULAR CATEGORY START-->
    <section class="popular-category-section pt-0">
        <div class="container">
            <div class="section-heading">
                <h3>popular categories</h3>
                <a href="{{ Route('listing') }}">view all categories<i class="icofont-rounded-right"></i></a>
            </div>
            <div class="category-wrapper">
                @if (count($categories) > 0)
                    @forelse ($categories as $key=>$c)
                        @if ($key <= 5)
                            <div class="category-box">
                                <a href="{{ Route('listing') }}">
                                    <figure>
                                        <img src="{{ URL::asset('public/uploads/frontend/category/' . $c['image']) }}"
                                            alt="Political" />
                                        <figcaption>{{ $c->category_name }}</figcaption>
                                    </figure>
                                </a>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @else
                    <div class="alert alert-danger" role="alert">
                        No Category Found
                    </div>
                @endif
                <!-- <div class="category-box">
                    <a href="#">
                        <figure>
                            <img src="{{ URL::asset('public/frontend/images/political.png') }}" alt="Political" />
                            <figcaption>Political</figcaption>
                        </figure>
                    </a>
                </div> -->
            </div>
        </div>
    </section>
    <!--POPULAR CATEGORY END-->

    <!--TRENDING VIDEO SECTION START-->
    <section class="trending-video-section bg-gray">
        <div class="container">
            <div class="section-heading text-center">
                <h3>fresh and trending videos</h3>
            </div>
            <div class="alert alert-danger" role="alert">
                No Trending Videos
            </div>
            <!-- <div class="trending-video-wrapper">
                <div class="trending-video-box">
                    <div class="video-box">
                        <a href="#" class="video-link">
                            <video poster="{{ URL::asset('public/frontend/images/tr1.png') }}" muted>
                                <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <span class="videoextab">Exclusive</span>
                        </a>
                        <div class="video-box-footer">
                            <a href="#">political</a>
                            <span><i class="icofont-clock-time"></i>60 Seconds</span>
                        </div>
                    </div>
                </div>
                <div class="trending-video-box">
                    <div class="video-box">
                        <a href="#" class="video-link">
                            <video poster="{{ URL::asset('public/frontend/images/tr2.png') }}" muted>
                                <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                        <div class="video-box-footer">
                            <a href="#">sports</a>
                            <span><i class="icofont-clock-time"></i>60 Seconds</span>
                        </div>
                    </div>
                </div>
                <div class="trending-video-box">
                    <div class="video-box">
                        <a href="#" class="video-link">
                            <video poster="{{ URL::asset('public/frontend/images/tr3.png') }}" muted>
                                <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                        <div class="video-box-footer">
                            <a href="#">war</a>
                            <span><i class="icofont-clock-time"></i>60 Seconds</span>
                        </div>
                    </div>
                </div>
                <div class="trending-video-box">
                    <div class="video-box">
                        <a href="#" class="video-link">
                            <video poster="{{ URL::asset('public/frontend/images/tr4.png') }}" muted>
                                <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                        <div class="video-box-footer">
                            <a href="#">Entertainment</a>
                            <span><i class="icofont-clock-time"></i>60 Seconds</span>
                        </div>
                    </div>
                </div>
                <div class="trending-video-box">
                    <div class="video-box">
                        <a href="#" class="video-link">
                            <video poster="{{ URL::asset('public/frontend/images/pexels-lina-mamone-1472612.jpg') }}" muted>
                                <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                        <div class="video-box-footer">
                            <a href="#">City</a>
                            <span><i class="icofont-clock-time"></i>60 Seconds</span>
                        </div>
                    </div>
                </div>
                <div class="trending-video-box">
                    <div class="video-box">
                        <a href="#" class="video-link">
                            <video poster="{{ URL::asset('public/frontend/images/tr6.png') }}" muted>
                                <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                        <div class="video-box-footer">
                            <a href="#">Natural Disaster</a>
                            <span><i class="icofont-clock-time"></i>60 Seconds</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="load-more-holder text-center">
                <a href="#">load more</a>
            </div> -->
        </div>
    </section>

    <section class="producing-section">
        <div class="container">
            <div class="section-heading text-center">
                <h3>Producing with us</h3>
            </div>
            <div class="producing-wrapper">
                @foreach($producing  as $p)
                <figure>
                    <img src="{{ URL::asset('public/uploads/admin/producing_image/' . $p->image ) }}" class="prodwthus" style="object-fit: contain;" alt="Tonkean" />
                </figure>
                @endforeach
                <!-- <figure>
                    <img src="{{ URL::asset('public/frontend/images/slogo2.png') }}" alt="Tonkean" />
                </figure>
                <figure>
                    <img src="{{ URL::asset('public/frontend/images/slogo3.png') }}" alt="Tonkean" />
                </figure>
                <figure>
                    <img src="{{ URL::asset('public/frontend/images/slogo4.png') }}" alt="Tonkean" />
                </figure> -->
                <!-- <figure>                                                                                                                                                                                                                                                                                           </figure> -->
            </div>
        </div>
    </section>
    <!--TRENDING VIDEO SECTION END-->

    <!--TESTIMONIAL SECTION START-->
    <section class="testimonial-section bg-gray">
        <div class="container">
            <div class="section-heading text-center">
                <h3>Testimonials</h3>
            </div>
            <div class="owl-carousel testimonial-slider">
                @foreach($testimonials as $testimonial)
                <div class="item">
                    <figure>
                        <img src="{{ URL::asset('public/frontend/images/qt.png') }}" alt="Icon" />
                    </figure>
                    <p>
                        {!!$testimonial->description!!}
                    </p>
                    <div class="user-info">
                        <div class="image-name">
                            <span class="image"><img src="{{ URL::asset('public/uploads/admin/testimonial_image/original/' . $testimonial->image ) }}"
                                    alt="{{ $testimonial->name }}" /></span>
                            <div class="name">
                                <h4>{{ $testimonial->name }}</h4>
                                <p>{{ $testimonial->subtitle }}</p>
                            </div>
                        </div>
                        <p>
                            <i class="icofont-location-pin"></i>{{ $testimonial->location }}
                        </p>
                    </div>
                </div>
                @endforeach
                {{-- <div class="item">
                    <figure>
                        <img src="{{ URL::asset('public/frontend/images/qt.png')'] alt="Icon" />
                    </figure>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidid unt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut
                        aliquip commodo.
                    </p>
                    <div class="user-info">
                        <div class="image-name">
                            <span class="image"><img src="{{ URL::asset('public/frontend/images/tuser2.png') }}"
                                    alt="Harry J. Walker" /></span>
                            <div class="name">
                                <h4>Harry J. Walker</h4>
                                <p>Entrepreneur</p>
                            </div>
                        </div>
                        <p>
                            <i class="icofont-location-pin"></i>Advaxis, California
                        </p>
                    </div>
                </div>
                <div class="item">
                    <figure>
                        <img src="{{ URL::asset('public/frontend/images/qt.png') }}" alt="Icon" />
                    </figure>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidid unt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut
                        aliquip commodo.
                    </p>
                    <div class="user-info">
                        <div class="image-name">
                            <span class="image"><img src="{{ URL::asset('public/frontend/images/tuser1.png') }}"
                                    alt="Willie Thompson" /></span>
                            <div class="name">
                                <h4>Willie Thompson</h4>
                                <p>Hexa</p>
                            </div>
                        </div>
                        <p>
                            <i class="icofont-location-pin"></i>Advaxis, California
                        </p>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!--TESTIMONIAL SECTION END-->

    <!--NEED ASSISTANCE SECTION START-->
    <section class="need-assistance-section">
        <div class="container">
            <div class="left-part">
                <h3><strong>Need Assistance?</strong> Your wish is our command.</h3>
                <a href="{{ Route('contact-us') }}">request a call back</a>
            </div>
        </div>
    </section>
    <!--NEED ASSISTANCE SECTION END-->
@stop


@section('js')
<script>
    // var currentSkin = getCurrentSkin();


    // function clearStoryLocalStorage() {
    //     for (let key in localStorage) {
    //         if (key.startsWith("zuck-")) {
    //             localStorage.removeItem(key);
    //         }
    //     }
    // }

    // // Clear Zuck.js related local storage keys before initializing stories
    // clearStoryLocalStorage();

    // // Converting PHP data to JavaScript object
    // var data_stories = {!! json_encode($data) !!};

    // // Create an array to hold the story items
    // var storyItems = [];

    // // Loop through each story and build the timeline items
    // <?php foreach ($data as $story) { ?>
    //     var mediaItems = [];
    //     <?php if (!empty($story->video)) { ?>
    //         mediaItems.push(["{{ $story->id }}-video", "video", 0, "public/uploads/frontend/story/video/{{ $story->video }}", "", '', false, false, timestamp()]);
    //     <?php } ?>
    //     <?php if (!empty($story->image)) { ?>
    //         mediaItems.push(["{{ $story->id }}-image", "photo", 3, "public/uploads/frontend/story/image/{{ $story->image }}", "", '', false, false, timestamp()]);
    //     <?php } ?>

    //     storyItems.push(
    //         Zuck.buildTimelineItem(
    //             "{{ $story->name }}",
    //             "public/uploads/frontend/profile_picture/original/{{ $story->profile_picture }}",
    //             "{{ $story->name }}",
    //             "https://yourwebsite.com", // Replace with the actual URL if needed
    //             timestamp(),
    //             mediaItems
    //         )
    //     );
    // <?php } ?>

    // // Initializing Zuck stories with the built story items
    // var stories = new Zuck('stories', {
    //     backNative: true,
    //     previousTap: true,
    //     skin: currentSkin['name'],
    //     autoFullScreen: currentSkin['params']['autoFullScreen'],
    //     avatars: currentSkin['params']['avatars'],
    //     paginationArrows: currentSkin['params']['paginationArrows'],
    //     list: currentSkin['params']['list'],
    //     cubeEffect: currentSkin['params']['cubeEffect'],
    //     localStorage: false, // Disable local storage
    //     stories: storyItems
    // });

















//     var currentSkin = getCurrentSkin();

// function clearStoryLocalStorage() {
//     for (let key in localStorage) {
//         if (key.startsWith("zuck-")) {
//             localStorage.removeItem(key);
//         }
//     }
// }

// // Clear Zuck.js related local storage keys before initializing stories
// clearStoryLocalStorage();

// // Converting PHP data to JavaScript object
// var data_stories = {!! json_encode($data) !!};

// // Create a map to hold the stories grouped by user ID
// var userStoriesMap = new Map();

// // Group stories by user ID
// <?php foreach ($data as $story) { ?>
//     var userId = "{{ $story->user_id }}";  // Ensure the correct user identifier is used
//     var userStories = userStoriesMap.get(userId) || [];
//     userStories.push({
//         id: "{{ $story->id }}",
//         type: "{{ !empty($story->video) ? 'video' : 'photo' }}",
//         src: "{{ !empty($story->video) ? 'public/uploads/frontend/story/video/' . $story->video : 'public/uploads/frontend/story/image/' . $story->image }}",
//         link: "https://yourwebsite.com", // Replace with the actual URL if needed
//         time: timestamp()
//     });
//     userStoriesMap.set(userId, userStories);
// <?php } ?>

// // Create an array to hold the story items
// var storyItems = [];

// // Loop through the map and build the timeline items
// userStoriesMap.forEach((userStories, userId) => {
//     var user = data_stories.find(story => story.user_id == userId); // Ensure the correct user identifier is used
//     if (user) {
//         var mediaItems = userStories.map(story => {
//             return [
//                 story.id,
//                 story.type,
//                 0,
//                 story.src,
//                 "", // Caption or title, if applicable
//                 "", // Link, if applicable
//                 false, // Is viewed (optional)
//                 false, // Is currently playing (optional)
//                 story.time
//             ];
//         });

//         storyItems.push(
//             Zuck.buildTimelineItem(
//                 userId,
//                 "public/uploads/frontend/profile_picture/original/" + user.profile_picture,
//                 user.name,
//                 "https://yourwebsite.com", // Replace with the actual URL if needed
//                 timestamp(),
//                 mediaItems
//             )
//         );
//     }
// });

// // Debug: Log storyItems to verify correctness
// console.log(storyItems);

// // Initializing Zuck stories with the built story items
// var stories = new Zuck('stories', {
//     backNative: true,
//     previousTap: true,
//     skin: currentSkin['name'],
//     autoFullScreen: currentSkin['params']['autoFullScreen'],
//     avatars: currentSkin['params']['avatars'],
//     paginationArrows: currentSkin['params']['paginationArrows'],
//     list: currentSkin['params']['list'],
//     cubeEffect: currentSkin['params']['cubeEffect'],
//     localStorage: false, // Disable local storage
//     stories: storyItems
// });


//==========================10-07-2024----------------------------------------================

// document.addEventListener('DOMContentLoaded', function() {
//     var currentSkin = getCurrentSkin();

//     function clearStoryLocalStorage() {
//         for (let key in localStorage) {
//             if (key.startsWith("zuck-")) {
//                 localStorage.removeItem(key);
//             }
//         }
//     }

//     // Clear Zuck.js related local storage keys before initializing stories
//     clearStoryLocalStorage();

//     // Assuming PHP variable $data is passed to JavaScript
//     var data_stories = {!! json_encode($data) !!};

//     // Create a map to hold the stories grouped by user ID
//     var userStoriesMap = new Map();

//     // Group stories by user ID
//     data_stories.forEach(story => {
//         var userId = story.user_id;
//         var userStories = userStoriesMap.get(userId) || [];
//         userStories.push({
//             id: story.id,
//             type: story.video ? 'video' : 'photo',
//             src: story.video ? 'public/uploads/frontend/story/video/' + story.video : 'public/uploads/frontend/story/image/' + story.image,
//             link: "https://yourwebsite.com", // Replace with the actual URL if needed
//             time: timestamp()
//         });
//         userStoriesMap.set(userId, userStories);
//     });

//     // Create an array to hold the story items
//     var storyItems = [];

//     // Loop through the map and build the timeline items
//     userStoriesMap.forEach((userStories, userId) => {
//         var user = data_stories.find(story => story.user_id == userId);
//         if (user) {
//             var mediaItems = userStories.map(story => {
//                 return [
//                     story.id,
//                     story.type,
//                     0,
//                     story.src,
//                     "", // Caption or title, if applicable
//                     "", // Link, if applicable
//                     false, // Is viewed (optional)
//                     false, // Is currently playing (optional)
//                     story.time
//                 ];
//             });

//             storyItems.push(
//                 Zuck.buildTimelineItem(
//                     userId,
//                     "public/uploads/frontend/profile_picture/original/" + user.profile_picture,
//                     user.name,
//                     "https://yourwebsite.com", // Replace with the actual URL if needed
//                     timestamp(),
//                     mediaItems
//                 )
//             );
//         }
//     });

//     // Debug: Log storyItems to verify correctness
//     console.log('Story items:', storyItems);

//     // Initializing Zuck stories with the built story items
//     var stories = new Zuck('stories', {
//         backNative: true,
//         previousTap: true,
//         skin: currentSkin['name'],
//         autoFullScreen: currentSkin['params']['autoFullScreen'],
//         avatars: currentSkin['params']['avatars'],
//         paginationArrows: currentSkin['params']['paginationArrows'],
//         list: currentSkin['params']['list'],
//         cubeEffect: currentSkin['params']['cubeEffect'],
//         localStorage: false, // Disable local storage to prevent last seen state from being saved
//         stories: storyItems
//     });

//     // Add click event listener to element with id 'stories'
//     document.getElementById('stories').addEventListener('click', function() {
//         // Show or interact with the loaded stories here, if needed
//         console.log('Clicked on div with id "stories"');
//         // You can access the 'stories' object returned from initializeStories function
//         // and perform any necessary actions
//     });
// });



/////////////////////////////=========================last(10-07-2024)=================
document.addEventListener('DOMContentLoaded', function() {
    var currentSkin = getCurrentSkin();

    function clearStoryLocalStorage() {
        for (let key in localStorage) {
            if (key.startsWith("zuck-")) {
                localStorage.removeItem(key);
            }
        }
    }

    // Clear Zuck.js related local storage keys before initializing stories
    clearStoryLocalStorage();

    // Assuming PHP variable $data is passed to JavaScript
    var data_stories = {!! json_encode($data) !!};

    // Create a map to hold the stories grouped by user ID
    var userStoriesMap = new Map();

    // Group stories by user ID
    data_stories.forEach(story => {
        var userId = story.user_id;
        var userStories = userStoriesMap.get(userId) || [];
        userStories.push({
            id: story.id,
            type: story.video ? 'video' : 'photo',
            src: story.video ? 'public/uploads/frontend/story/video/' + story.video : 'public/uploads/frontend/story/image/' + story.image,
            link: "https://yourwebsite.com", // Replace with the actual URL if needed
            time: Math.floor(Date.now() / 1000)
        });
        userStoriesMap.set(userId, userStories);
    });

    // Create an array to hold the story items
    var storyItems = [];

    // Loop through the map and build the timeline items
    userStoriesMap.forEach((userStories, userId) => {
        var user = data_stories.find(story => story.user_id == userId);
        if (user) {
            var mediaItems = userStories.map(story => {
                return [
                    story.id,
                    story.type,
                    0,
                    story.src,
                    "", // Caption or title, if applicable
                    "", // Link, if applicable
                    false, // Is viewed (optional)
                    false, // Is currently playing (optional)
                    story.time
                ];
            });

            storyItems.push(
                Zuck.buildTimelineItem(
                    userId,
                    "public/uploads/frontend/profile_picture/original/" + user.profile_picture,
                    user.name,
                    "https://yourwebsite.com", // Replace with the actual URL if needed
                    Math.floor(Date.now() / 1000),
                    mediaItems
                )
            );
        }
    });

    // Debug: Log storyItems to verify correctness
    console.log('Story items:', storyItems);

    // Initializing Zuck stories with the built story items
    var stories = new Zuck('stories', {
        backNative: true,
        previousTap: true,
        skin: currentSkin['name'],
        autoFullScreen: currentSkin['params']['autoFullScreen'],
        avatars: currentSkin['params']['avatars'],
        paginationArrows: currentSkin['params']['paginationArrows'],
        list: currentSkin['params']['list'],
        cubeEffect: currentSkin['params']['cubeEffect'],
        localStorage: false, // Disable local storage to prevent last seen state from being saved
        stories: storyItems
    });

    // Add click event listener to element with id 'stories'
    document.getElementById('stories').addEventListener('click', function() {
        // Show or interact with the loaded stories here, if needed
        console.log('Clicked on div with id "stories"');
    });
});











// document.addEventListener('DOMContentLoaded', function() {
//     var currentSkin = getCurrentSkin();

//     // Clear Zuck.js related local storage keys before initializing stories
//     function clearStoryLocalStorage() {
//         for (let key in localStorage) {
//             if (key.startsWith("zuck-")) {
//                 localStorage.removeItem(key);
//             }
//         }
//     }

//     // Function to check if all stories of a user have been seen
//     function allUserStoriesSeen(userId) {
//         var zuckStories = document.querySelectorAll(`.zuck-story[data-id="${userId}"] .items li`);
//         return Array.from(zuckStories).every(story => story.classList.contains('seen'));
//     }

//     // Function to clear local storage keys for a specific user
//     function clearUserStoryLocalStorage(userId) {
//         for (let key in localStorage) {
//             if (key.startsWith("zuck-" + userId)) {
//                 localStorage.removeItem(key);
//             }
//         }
//     }

//     // Assuming PHP variable $data is passed to JavaScript
//     var data_stories = {!! json_encode($data) !!};

//     // Create a map to hold the stories grouped by user ID
//     var userStoriesMap = new Map();

//     // Group stories by user ID
//     data_stories.forEach(story => {
//         var userId = story.user_id;
//         var userStories = userStoriesMap.get(userId) || [];
//         userStories.push({
//             id: story.id,
//             type: story.video ? 'video' : 'photo',
//             src: story.video ? 'public/uploads/frontend/story/video/' + story.video : 'public/uploads/frontend/story/image/' + story.image,
//             link: "https://yourwebsite.com", // Replace with the actual URL if needed
//             time: Math.floor(Date.now() / 1000)
//         });
//         userStoriesMap.set(userId, userStories);
//     });

//     // Create an array to hold the story items
//     var storyItems = [];

//     // Loop through the map and build the timeline items
//     userStoriesMap.forEach((userStories, userId) => {
//         var user = data_stories.find(story => story.user_id == userId);
//         if (user) {
//             var mediaItems = userStories.map(story => {
//                 return [
//                     story.id,
//                     story.type,
//                     0,
//                     story.src,
//                     "", // Caption or title, if applicable
//                     "", // Link, if applicable
//                     false, // Is viewed (optional)
//                     false, // Is currently playing (optional)
//                     story.time
//                 ];
//             });

//             storyItems.push(
//                 Zuck.buildTimelineItem(
//                     userId,
//                     "public/uploads/frontend/profile_picture/original/" + user.profile_picture,
//                     user.name,
//                     "https://yourwebsite.com", // Replace with the actual URL if needed
//                     Math.floor(Date.now() / 1000),
//                     mediaItems
//                 )
//             );
//         }
//     });

//     // Debug: Log storyItems to verify correctness
//     console.log('Story items:', storyItems);

//     // Initialize Zuck.js stories only once
//     var storiesInstance = new Zuck('stories', {
//         backNative: true,
//         previousTap: true,
//         skin: currentSkin['name'],
//         autoFullScreen: currentSkin['params']['autoFullScreen'],
//         avatars: currentSkin['params']['avatars'],
//         paginationArrows: currentSkin['params']['paginationArrows'],
//         list: currentSkin['params']['list'],
//         cubeEffect: currentSkin['params']['cubeEffect'],
//         localStorage: true, // Enable local storage for tracking viewed stories
//         stories: storyItems,
//         callbacks: {
//             onEndStoryItem: function(storyId, callback) {
//                 console.log('Story item ended:', storyId);
//                 var userId = storyId.split('-')[0]; // Extract userId from storyId
//                 // Check if all stories of the user are seen
//                 if (allUserStoriesSeen(userId)) {
//                     clearUserStoryLocalStorage(userId); // Clear seen state for this user
//                     // Force Zuck to reload stories for the user
//                     var userStoryElement = document.querySelector(`.zuck-story[data-id="${userId}"]`);
//                     if (userStoryElement) {
//                         userStoryElement.classList.remove('seen');
//                         userStoryElement.querySelectorAll('.items li').forEach(function(storyItem) {
//                             storyItem.classList.remove('seen');
//                         });
//                     }
//                     callback();
//                 }
//             },
//             onClose: function(storyId, callback) {
//                 console.log('Story view closed:', storyId);
//                 var userId = storyId.split('-')[0]; // Extract userId from storyId
//                 if (allUserStoriesSeen(userId)) {
//                     clearUserStoryLocalStorage(userId); // Clear seen state for this user
//                 }
//                 callback();
//             }
//         }
//     });

//     // Add click event listener to element with id 'stories'
//     document.getElementById('stories').addEventListener('click', function() {
//         // Clear local storage to ensure stories restart from the beginning
//         clearStoryLocalStorage();
//         storiesInstance.update({
//             backNative: true,
//             previousTap: true,
//             skin: currentSkin['name'],
//             autoFullScreen: currentSkin['params']['autoFullScreen'],
//             avatars: currentSkin['params']['avatars'],
//             paginationArrows: currentSkin['params']['paginationArrows'],
//             list: currentSkin['params']['list'],
//             cubeEffect: currentSkin['params']['cubeEffect'],
//             localStorage: true, // Enable local storage for tracking viewed stories
//             stories: storyItems,
//             callbacks: {
//                 onEndStoryItem: function(storyId, callback) {
//                     console.log('Story item ended:', storyId);
//                     var userId = storyId.split('-')[0]; // Extract userId from storyId
//                     // Check if all stories of the user are seen
//                     if (allUserStoriesSeen(userId)) {
//                         clearUserStoryLocalStorage(userId); // Clear seen state for this user
//                         // Force Zuck to reload stories for the user
//                         var userStoryElement = document.querySelector(`.zuck-story[data-id="${userId}"]`);
//                         if (userStoryElement) {
//                             userStoryElement.classList.remove('seen');
//                             userStoryElement.querySelectorAll('.items li').forEach(function(storyItem) {
//                                 storyItem.classList.remove('seen');
//                             });
//                         }
//                         callback();
//                     }
//                 },
//                 onClose: function(storyId, callback) {
//                     console.log('Story view closed:', storyId);
//                     var userId = storyId.split('-')[0]; // Extract userId from storyId
//                     if (allUserStoriesSeen(userId)) {
//                         clearUserStoryLocalStorage(userId); // Clear seen state for this user
//                     }
//                     callback();
//                 }
//             }
//         });
//     });
// });





// document.addEventListener('DOMContentLoaded', function() {
//     var currentSkin = getCurrentSkin();

//     // Clear Zuck.js related local storage keys before initializing stories
//     function clearStoryLocalStorage() {
//         for (let key in localStorage) {
//             if (key.startsWith("zuck-")) {
//                 localStorage.removeItem(key);
//             }
//         }
//     }

//     // Function to check if all stories of a user have been seen
//     function allUserStoriesSeen(userId) {
//         var zuckStories = document.querySelectorAll(`.zuck-story[data-id="${userId}"] .items li`);
//         return Array.from(zuckStories).every(story => story.classList.contains('seen'));
//     }

//     // Function to clear local storage keys for a specific user
//     function clearUserStoryLocalStorage(userId) {
//         for (let key in localStorage) {
//             if (key.startsWith("zuck-" + userId)) {
//                 localStorage.removeItem(key);
//             }
//         }
//     }

//     // Assuming PHP variable $data is passed to JavaScript
//     var data_stories = {!! json_encode($data) !!};

//     // Create a map to hold the stories grouped by user ID
//     var userStoriesMap = new Map();

//     // Group stories by user ID
//     data_stories.forEach(story => {
//         var userId = story.user_id;
//         var userStories = userStoriesMap.get(userId) || [];
//         userStories.push({
//             id: story.id,
//             type: story.video ? 'video' : 'photo',
//             src: story.video ? 'public/uploads/frontend/story/video/' + story.video : 'public/uploads/frontend/story/image/' + story.image,
//             link: "https://yourwebsite.com", // Replace with the actual URL if needed
//             time: Math.floor(Date.now() / 1000)
//         });
//         userStoriesMap.set(userId, userStories);
//     });

//     // Create an array to hold the story items
//     var storyItems = [];

//     // Loop through the map and build the timeline items
//     userStoriesMap.forEach((userStories, userId) => {
//         var user = data_stories.find(story => story.user_id == userId);
//         if (user) {
//             var mediaItems = userStories.map(story => {
//                 return [
//                     story.id,
//                     story.type,
//                     0,
//                     story.src,
//                     "", // Caption or title, if applicable
//                     "", // Link, if applicable
//                     false, // Is viewed (optional)
//                     false, // Is currently playing (optional)
//                     story.time
//                 ];
//             });

//             storyItems.push(
//                 Zuck.buildTimelineItem(
//                     userId,
//                     "public/uploads/frontend/profile_picture/original/" + user.profile_picture,
//                     user.name,
//                     "https://yourwebsite.com", // Replace with the actual URL if needed
//                     Math.floor(Date.now() / 1000),
//                     mediaItems
//                 )
//             );
//         }
//     });

//     // Debug: Log storyItems to verify correctness
//     console.log('Story items:', storyItems);

//     // Initialize Zuck.js stories only once
//     var storiesInstance = new Zuck('stories', {
//         backNative: true,
//         previousTap: true,
//         skin: currentSkin['name'],
//         autoFullScreen: currentSkin['params']['autoFullScreen'],
//         avatars: currentSkin['params']['avatars'],
//         paginationArrows: currentSkin['params']['paginationArrows'],
//         list: currentSkin['params']['list'],
//         cubeEffect: currentSkin['params']['cubeEffect'],
//         localStorage: true, // Enable local storage for tracking viewed stories
//         stories: storyItems,
//         callbacks: {
//             onEndStoryItem: function(storyId, callback) {
//                 console.log('Story item ended:', storyId);
//                 var userId = storyId.split('-')[0]; // Extract userId from storyId
//                 // Check if all stories of the user are seen
//                 if (allUserStoriesSeen(userId)) {
//                     clearUserStoryLocalStorage(userId); // Clear seen state for this user
//                     // Force Zuck to reload stories for the user
//                     var userStoryElement = document.querySelector(`.zuck-story[data-id="${userId}"]`);
//                     if (userStoryElement) {
//                         userStoryElement.classList.remove('seen');
//                         userStoryElement.querySelectorAll('.items li').forEach(function(storyItem) {
//                             storyItem.classList.remove('seen');
//                         });
//                     }
//                     callback();
//                 }
//             },
//             onClose: function(storyId, callback) {
//                 console.log('Story view closed:', storyId);
//                 var userId = storyId.split('-')[0]; // Extract userId from storyId
//                 if (allUserStoriesSeen(userId)) {
//                     clearUserStoryLocalStorage(userId); // Clear seen state for this user
//                 }
//                 callback();
//             }
//         }
//     });

//     // Add click event listener to element with id 'stories'
//     document.getElementById('stories').addEventListener('click', function() {
//         // Clear local storage to ensure stories restart from the beginning
//         clearStoryLocalStorage();
//         storiesInstance.update({
//             backNative: true,
//             previousTap: true,
//             skin: currentSkin['name'],
//             autoFullScreen: currentSkin['params']['autoFullScreen'],
//             avatars: currentSkin['params']['avatars'],
//             paginationArrows: currentSkin['params']['paginationArrows'],
//             list: currentSkin['params']['list'],
//             cubeEffect: currentSkin['params']['cubeEffect'],
//             localStorage: true, // Enable local storage for tracking viewed stories
//             stories: storyItems,
//             callbacks: {
//                 onEndStoryItem: function(storyId, callback) {
//                     console.log('Story item ended:', storyId);
//                     var userId = storyId.split('-')[0]; // Extract userId from storyId
//                     // Check if all stories of the user are seen
//                     if (allUserStoriesSeen(userId)) {
//                         clearUserStoryLocalStorage(userId); // Clear seen state for this user
//                         // Force Zuck to reload stories for the user
//                         var userStoryElement = document.querySelector(`.zuck-story[data-id="${userId}"]`);
//                         if (userStoryElement) {
//                             userStoryElement.classList.remove('seen');
//                             userStoryElement.querySelectorAll('.items li').forEach(function(storyItem) {
//                                 storyItem.classList.remove('seen');
//                             });
//                         }
//                         callback();
//                     }
//                 },
//                 onClose: function(storyId, callback) {
//                     console.log('Story view closed:', storyId);
//                     var userId = storyId.split('-')[0]; // Extract userId from storyId
//                     if (allUserStoriesSeen(userId)) {
//                         clearUserStoryLocalStorage(userId); // Clear seen state for this user
//                     }
//                     callback();
//                 }
//             }
//         });
//     });
// });

//==================================last=========================================================
























    // var stories = new Zuck('stories', {
    //     backNative: true,
    //     previousTap: true,
    //     skin: currentSkin['name'],
    //     autoFullScreen: currentSkin['params']['autoFullScreen'],
    //     avatars: currentSkin['params']['avatars'],
    //     paginationArrows: currentSkin['params']['paginationArrows'],
    //     list: currentSkin['params']['list'],
    //     cubeEffect: currentSkin['params']['cubeEffect'],
    //     localStorage: true,
    //     stories:
    //     [
    //         Zuck.buildTimelineItem(
    //             "ramon",
    //             "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/users/1.jpg",
    //             "Ramon",
    //             "https://ramon.codes",
    //             timestamp(),
    //             [
    //                 ["ramon-1", "photo", 3, "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/1.jpg", "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/1.jpg", '', false, false, timestamp()],
    //                 ["ramon-2", "video", 0, "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/2.mp4", "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/2.jpg", '', false, false, timestamp()],
    //                 ["ramon-3", "photo", 3, "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/3.png", "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/3.png", 'https://ramon.codes', 'Visit my Portfolio', false, timestamp()]
    //             ]
    //         ),
    //         Zuck.buildTimelineItem(
    //             "gorillaz",
    //             "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/users/2.jpg",
    //             "Gorillaz",
    //             "",
    //             timestamp(),
    //             [
    //                 ["gorillaz-1", "video", 0, "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/4.mp4", "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/4.jpg", '', false, false, timestamp()],
    //                 ["gorillaz-2", "photo", 3, "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/5.jpg", "https://raw.githubusercontent.com/ramon82/assets/master/zuck.js/stories/5.jpg", '', false, false, timestamp()],
    //             ]
    //         )
    //     ]
    // });
</script>
@stop
