<div class="dash-bottom-part">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-8">
                <div class="dash_headingbx nwstl">
                    <h2 class="dash_heading pl-0">Project: {{$project->title}}</h2>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <!-- <div class="input-group search mb-3">
            <input type="text" class="form-control" wire:model.defer="title" placeholder="" aria-label="Title"
                   aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" wire:click.prevent="render" wire:target="render"
                        wire:loading.class="d-none" type="button"><i class="icofont-search-1"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" wire:loading wire:target="render">
                    <i class="fa fa-circle-o-notch fa-spin"></i>
                </button>
            </div> -->
                {{-- <button type="submit" class="common-btn green" id="showfilter"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> --}}
            </div>
        </div>
        <div class="row mt-4 mb-4 filter d-none">
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control" wire:model.defer="talent_type" id="exampleFormControlSelect1">
                      <option value="">Talent Type</option>
                      <option value="1">Registered Talent</option>
                      <option value="2">Verified Talent</option>
                      <option value="3">Qualified Talent</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control" wire:model.defer="category" id="exampleFormControlSelect1">
                    <option value="">Category / Skills</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->translation->category_name}}</option> 
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control" wire:model.defer="country" id="exampleFormControlSelect1">
                    <option value="">Location</option>
                    @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->country_name}}</option> 
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control" wire:model.defer="language" id="exampleFormControlSelect1">
                    <option value="">Language</option>
                    @foreach ($languages as $language)
                    <option value="{{$language->id}}">{{$language->Language}}</option> 
                    @endforeach
                    </select>
                </div>
                <div class="text-right">
                    <button class="common-btn green" wire:click.prevent="render" wire:target="render"
                        wire:loading.class="d-none" type="button">Search
                    </button>
                    <button type="button" class="common-btn green" wire:loading wire:target="render">
                        <i class="fa fa-circle-o-notch fa-spin"></i> Processing
                    </button>
                    {{-- <button type="submit" class="common-btn green">Search</button> --}}
                </div>
                

            </div>
        </div>
   
    <div class="white_contentbx customnw">

        <div class="dashtab_area">
            <div class="table_bx">
                <div class="table-responsive">
                    <table class="table common_nwtable table-striped mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Project</th>
                                <th scope="col">Talent Name</th>
                                {{-- <th scope="col">User Email</th> --}}
                                <th scope="col">Budget Amount</th>
                                <th scope="col">Agreed Amount</th>
                                <th scope="col">Agreed Deadline</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="action_bx text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($award_projects as $award_project)
                            <tr>
                                <td data-label="Project"><a
                                        href="{{route('task_details',base64_encode($award_project->project->id))}}">{{$award_project->title}}</a>
                                </td>
                                <td data-label="name"><a
                                        href="{{route('user-profile', [base64_encode($award_project->user_id),base64_encode($award_project->bid_id)])}}">{{$award_project->user->name}}</a>
                                </td>
                                {{-- <td data-label="name">{{$award_project->user->email}}</td> --}}
                                <td data-label="name">${{$award_project->project->budget}}</td>
                                <td data-label="name">${{$award_project->billable_target}}</td>
                                <td data-label="Deadline">
                                    {{!empty($award_project->deadline)?date('jS M
                                    Y',strtotime($award_project->deadline)):''}}
                                </td>
                                <td data-label="Status">

                                    @if ($award_project->bid_status==='1')
                                    <span class="badge badge-success mb-0 even-larger-badge">Awarded</span>
                                    @else
                                    <span class="badge badge-danger mb-0 even-larger-badge">Pending</span>
                                    @endif

                                </td>

                                <td data-label="Action" class="text-center actionBtn">
                                    {{-- <button onclick="view_proposal({{ $award_project->bid_id }})"
                                        class="btn btn-small btn-success"><i class="fa fa-eye" aria-hidden="true"></i>
                                    </button> --}}
                                    <a href="{{route('user.view-proposal-award',base64_encode($award_project->bid_id))}}"
                                        target="_blank" class="btn btn-small btn-success"><i class="fa fa-eye"
                                            aria-hidden="true"></i>
                                    </a>

                                    {{-- <a
                                        href="{{route('user.award-project.detail',base64_encode($award_project->project_id))}}"
                                        class="btn btn-small btn-success" data-toggle="tooltip" data-placement="bottom"
                                        title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                                    {{-- <button wire:click="hireModel({{ $award_project->bid_id }})"
                                        onclick="confirm('Are you sure you want to award the user from this bid?') || event.stopImmediatePropagation()"
                                        class="btn btn-small btn-warning" data-toggle="tooltip" data-placement="bottom"
                                        title="Award"><i class="icofont-search-job" aria-hidden="true"></i></button>
                                    --}}
                                    {{-- <a href="{{route('user.accept-proposal-award',base64_encode($award_project->bid_id))}}"
                                        onclick="confirm('Are you sure you want to hire this Talent for your Job?') || event.stopImmediatePropagation()"
                                        class="btn btn-small btn-warning" data-toggle="tooltip" data-placement="bottom"
                                        title="Award"><i class="icofont-search-job" aria-hidden="true"></i></a> --}}
                                    {{-- <button @click="open = !open"
                                        wire:click="proposal_award({{ $award_project->bid_id }})"
                                        class="btn btn-small btn-warning" data-toggle="tooltip" data-placement="bottom"
                                        title="Award">Award</button> --}}
                                    <button wire:click="proposal_delete({{ $award_project->bid_id }})"
                                        onclick="confirm('Are you sure you want to delete the user from this bid?') || event.stopImmediatePropagation()"
                                        class="btn btn-small btn-danger" data-toggle="tooltip" data-placement="bottom"
                                        title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    <!-- <a href="#" class="common-btn nw_color"><i class="icofont-edit"></i></a> -->
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div class="text-center">
                                        <h6 class="table_headingsmallpara mb-0">
                                            There are no proposal projects that match your search
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagintaion bottom-pagination">
                        {{ $award_projects->links('vendor.pagination.custom') }}
                        {{-- {!! $award_projects->links() !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>




<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="htmlviewproposal"></span>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" x-on:click.prevent="confirmDelete(deleteId)" class="btn btn-danger close-modal"
                    data-dismiss="modal">Yes, Delete</button>
            </div> --}}
        </div>
    </div>
</div>
<script>
    function proposal_delete($deleteid) {
        Livewire.emit('proposal_delete', $deleteid);
        $('.modal').modal('hide');
    }
</script>
<script>
    function view_proposal(bid_id) {
        if (bid_id) {
            var url = full_path + "get-details-proposal";
            var csrf_token = $('meta[name="csrf-token"]').attr("content");
            var data = { bid_id: bid_id };
            ajaxindicatorstart();
            $.ajax({
                url: url,
                headers: { "X-CSRF-TOKEN": csrf_token },
                type: "POST",
                dataType: "json",
                //processData: false,
                //contentType: false,
                data: data,
                success: function (resp) {
                    ajaxindicatorstop();
                    if (resp.status == "success") {

                        $('#exampleModal').modal('show');
                        // $("#htmleditteamplay").remove();
                        $("#htmlviewproposal").html(resp.content);

                        // save();

                    } else {
                        console.log(resp);
                        notie.alert({
                            type: "error",
                            text: '<i class="fa fa-times"></i> ' + resp.errors,
                            time: 3,
                        });
                    }
                },
            });

        }
    }
</script>



<!-- modal one  -->

{{--
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
    Launch demo modal 1
</button> --}}

<!-- Modal -->
{{-- <div class="modal right fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="greenLink" data-dismiss="modal" aria-label="Close"><i class="fa fa-chevron-left"
                        aria-hidden="true"></i></a>

            </div>
            <div class="modal-body">
                <div class="ppProfile sideProfile bg-white p-0 border-bottom pb-4">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="d-flex">
                                <div>
                                    <a class="aNone" href="#">
                                        <img src="https://randomuser.me/api/portraits/women/81.jpg" alt="">
                                    </a>
                                </div>
                                <div class="flex-fill">
                                    <a class="aNone" href="#">
                                        <h5>Nikolay G.</h5>
                                    </a>
                                    <p><small><i class="fa fa-map-marker" aria-hidden="true"></i> Jammu, India - 7:31 pm
                                            local
                                            time</small></p>
                                    <p class="giStatus"><i class="fa fa-bolt" aria-hidden="true"></i> Available now</p>
                                    <a class="greenLink" href="#">View Profile</a>
                                    <div class="d-flex">
                                        <div>
                                            <h5>80%</h5>
                                            <div class="progressMain smProgress">
                                                <!-- <div class="progress-bar">
                                        <div data-size="80" class="progress" style="width: 80%;"></div>
                                    </div> -->
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <h6><small>Job success</small></h6>
                                        </div>
                                        <div class="ml-5 mt-4">
                                            <p class="text-muted"><small><i class="fa fa-star" aria-hidden="true"></i>
                                                    TOP RATED PLUS</small></p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 text-center mHireBtn">
                            <div> <button class="btn btn_site btn_fixed ">Hire Talent</button></div>
                            <div> <button class="btn btn_site btn_fixed mt-4">Message</button></div>
                        </div>
                    </div>
                </div>


                <div class="mt-4">

                    <div class="row mRow_reverse">
                        <div class="col-md-9">
                            <h4 class="ppTitleBold">Proposal Details :</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                        <div class="col-md-3 orderF">
                            <div class="text-center">
                                <h3 class="m-0">$500.00</h3>
                                <p>Proposed Bid</p>
                            </div>
                        </div>
                    </div>

                    <h4 class="ppTitleBold">Cover Letter :</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.</p>

                    <h4 class="ppTitleBold">Describe your recent & relevant experience with similar projects :</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.</p>

                    <h4 class="ppTitleBold">Include a link to your profile and/or website :</h4>
                    <a class="greenLink" href="#"><i class="fa fa-link" aria-hidden="true"></i> Link here</a>
                    <a class="greenLink" href="#"><i class="fa fa-link" aria-hidden="true"></i> Link here</a>
                    <a class="greenLink" href="#"><i class="fa fa-link" aria-hidden="true"></i> Link here</a>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.</p>

                    <h4 class="ppTitleBold">Describe your approach to development, testing and improving QA :</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.</p>

                </div>
            </div>

        </div>
    </div>
</div> --}}

<!-- end of modal one  -->

<!-- modal two -->

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
    Launch demo modal 2
</button> --}}

<!-- Modal -->
{{-- <div class="modal right fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="greenLink" data-dismiss="modal" aria-label="Close"><i class="fa fa-chevron-left"
                        aria-hidden="true"></i></a>

            </div>
            <div class="modal-body">
                <div class="ppProfile sideProfile bg-white p-0 border-bottom pb-4">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="d-flex">
                                <div>
                                    <a class="aNone" href="#">
                                        <img src="https://randomuser.me/api/portraits/women/81.jpg" alt="">
                                    </a>
                                </div>
                                <div class="flex-fill">
                                    <a class="aNone" href="#">
                                        <h5>Nikolay G.</h5>
                                    </a>
                                    <p><small><i class="fa fa-map-marker" aria-hidden="true"></i> Jammu, India - 7:31 pm
                                            local
                                            time</small></p>
                                    <p class="giStatus"><i class="fa fa-bolt" aria-hidden="true"></i> Available now</p>
                                    <a class="greenLink" href="#">View Profile</a>
                                    <div class="d-flex">
                                        <div>
                                            <h5>80%</h5>
                                            <div class="progressMain smProgress">
                                                <!-- <div class="progress-bar">
                                        <div data-size="80" class="progress" style="width: 80%;"></div>
                                    </div> -->
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <h6><small>Job success</small></h6>
                                        </div>
                                        <div class="ml-5 mt-4">
                                            <p class="text-muted"><small><i class="fa fa-star" aria-hidden="true"></i>
                                                    TOP RATED PLUS</small></p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 text-center mHireBtn">
                            <div> <button class="btn btn_site btn_fixed ">Hire Talent</button></div>
                            <div> <button class="btn btn_site btn_fixed mt-4">Message</button></div>
                        </div>
                    </div>
                </div>


                <div class="mt-4">

                    <div class="row mRow_reverse">
                        <div class="col-md-9">
                            <h4 class="ppTitleBold">Proposal Details :</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                        <div class="col-md-3 orderF">
                            <div class="text-center">
                                <h3 class="m-0">$500.00</h3>
                                <p>Proposed Bid</p>
                            </div>
                        </div>
                    </div>

                    <h4 class="ppTitleBold">Cover Letter :</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.</p>



                </div>
            </div>

        </div>
    </div>
</div> --}}

<!-- end of modal two  -->