<div>

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="avatar avatar-md" style="background-image: url({{$author->picture}})"></span>
            </div>
            <div class="col-md-6">
                <h2 class="page-title">{{$author->name}}</h2>
                <div class="page-subtitle">
                    <div class="row">
                        <div class="col-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/building-skyscraper -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 21l18 0" />
                                <path d="M5 21v-14l8 -4v18" />
                                <path d="M19 21v-10l-6 -4" />
                                <path d="M9 9l0 .01" />
                                <path d="M9 12l0 .01" />
                                <path d="M9 15l0 .01" />
                                <path d="M9 18l0 .01" />
                            </svg>
                            <a href="#" class="text-reset">@ {{$author->username}} | {{$author->authorType->name}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto  d-md-flex">
                <input type="file" name="file" id="changeAuthorPictureFile" class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
                <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('changeAuthorPictureFile').click();">
                    chage picture
                </a>

            </div>
        </div>

    </div>