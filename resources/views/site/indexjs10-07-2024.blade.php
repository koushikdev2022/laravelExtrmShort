<script>
    var currentSkin = getCurrentSkin();

    //ajax for contacts to load
    // function loadStories() {
    //     $.ajax({
    //         url: full_path + "getStories",
    //         success: function(response) {
    //             var details = response;
    //         }
    //     });
    // }

    var data_stories = {!! json_encode($data) !!};

        // alert(data_stories)

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
    //     stories: $.each(data_stories, function(index, value) {
    //         // full_path + "public/uploads/frontend/profile_picture/preview/".value.profile_picture,

    //         // alert(value.video)

    //         Zuck.buildTimelineItem(
    //             value.id,
    //             value.name,
    //             "https://ramon.codes",
    //             timestamp(),
    //             [
    //                 // ["ramon-1", "photo", 3,
    //                 //     "public/uploads/frontend/story/image/"+value.image,
    //                 //     "public/uploads/frontend/story/image/"+value.image,
    //                 //     '', false, false, timestamp()
    //                 // ],

    //                 ["ramon-2", "video", 0,
    //                     "public/uploads/frontend/story/video/KX38v2BhgTF55iZSQYMyeInR6t1oEu1663310532.mp4",
    //                     "public/uploads/frontend/story/video/",
    //                     '', false, false, timestamp()
    //                 ],

    //                 // ["ramon-3", "photo", 3,
    //                 //     "/public/uploads/frontend/story/image/"+value.image,
    //                 //     "/public/uploads/frontend/story/image/"+value.image,
    //                 //     'https://ramon.codes', 'Visit my Portfolio', false, timestamp()
    //                 // ]

    //             ]
    //         )
    //     })
    // });

    var stories = new Zuck('stories', {
        backNative: true,
        previousTap: true,
        skin: currentSkin['name'],
        autoFullScreen: currentSkin['params']['autoFullScreen'],
        avatars: currentSkin['params']['avatars'],
        paginationArrows: currentSkin['params']['paginationArrows'],
        list: currentSkin['params']['list'],
        cubeEffect: currentSkin['params']['cubeEffect'],
        localStorage: true,
        stories:
        [

            <?php foreach ($data as $key=>$data){ ?>

                Zuck.buildTimelineItem(
                    "{{$data->name }}",
                    "public/uploads/frontend/profile_picture/original/{{$data->profile_picture }}",
                    "{{$data->name }}",
                    "https://ramon.codes",
                    timestamp(),
                    [
                        ["ramon-2", "video", 0, "public/uploads/frontend/story/video/{{$data->video}}", "", '', false, false, timestamp()],
                        // ["ramon-1", "photo", 3, "public/uploads/frontend/story/image/{{$data->image}}", "", '', false, false, timestamp()],

                    ]
                ),

            <?php } ?>

        ]
    });







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