@extends('layouts.customer')
@section('page-title')
Performance Detail
@endsection

@section('content')
    @if($detail != null)
        <main>
            <div class="content-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Performance Details</h2>
                    </div>                
                    <div class="col-md-12">
                        <div class="prf-detailwrap">
                            <div class="row">
                                <div class="col-md-10 mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="m-0">Client</h3>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text"
                                            value="{{ $detail["customer"]->first_name.' '.$detail["customer"]->last_name }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <input type="text" value="{{ date('d-m-Y', strtotime($detail->created_at))}}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="m-0">Generic</h3>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Time Login</label>
                                        <input type="text" value="{{ $detail->time_login }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Time Logout</label>
                                        <input type="text" value="{{ $detail->time_logout }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Pre workout Meal</label>
                                        <input type="text" value="{{ $detail->per_workout_meal }}" class="form-control"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Hours of Sleep the Previous Day</label>
                                        <input type="text" value="{{ $detail->hours_of_sleep_prev_day }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Step Count the Previous Day</label>
                                        <input type="text" value="{{ $detail->step_count_prev_day }}" class="form-control"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Any activity done the Previous Day which Could
                                            Hamper Recovery</label>
                                        <input type="text" value="{{ $detail->prev_day_activity }}" class="form-control"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Calorie Count During the Session </label>
                                        <input type="text" value="{{ $detail->calories_count_during_session }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Any aches or Pains to be Mindful of</label>
                                        <input type="text" value="{{ $detail->any_aches_or_pains }}" class="form-control"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Mood and Energy level</label>
                                        <input type="text" value="{{ $detail->mood_and_energy_level }}" class="form-control"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Average Heart Rate during the Session</label>
                                        <input type="text" value="{{ $detail->avg_heart_rate_during_session }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h3>Mobility & Stretches</h3>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Time Taken</label>
                                        <input type="text" value="{{ $detail->time_taken }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Any Difficulty Noticed</label>
                                        <input type="text" value="{{ $detail->any_difficulty_noticed }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-10 mt-3">
                                    <h3>Core & Balance Circuit Training </h3>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">No of Reps for Each Workout</label>
                                        <input type="text" placeholder="10" class="form-control" disabled value="{{ $detail->no_of_reps_for_each_workout }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Number of Laps</label>
                                        <input type="text" placeholder="08" class="form-control" disabled value="{{ $detail->no_of_laps }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Whether Completed within the Stipulated time </label>
                                        <input type="text" placeholder="10:00 AM" class="form-control" disabled value="{{ $detail->stipulated_time }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Any Difficulty Noticed</label>
                                        <input type="text" placeholder="Difficulty" class="form-control" disabled value="{{ $detail->difficulty }}">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Additional Comments</label>
                                        <textarea
                                            placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                                            class="form-control" disabled>{{ $detail->additional_comments }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-10 mt-3">
                                    <h3>Speed/Agility Workout</h3>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">No of Reps for Each Workout</label>
                                        <input type="text" placeholder="10" class="form-control" disabled value="{{ $detail->agility_workout }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Number of Laps</label>
                                        <input type="text" placeholder="08" class="form-control" disabled value="{{ $detail->agility_no_of_laps }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Whether Completed within the Stipulated
                                            time </label>
                                        <input type="text" placeholder="10:00 AM" class="form-control" disabled value="{{ $detail->agility_stipulated_time }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Any Difficulty Noticed</label>
                                        <input type="text" placeholder="Difficulty" class="form-control" disabled value="{{ $detail->agility_difficulty_noticed }}">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Additional Comments</label>
                                        <textarea
                                            placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                                            class="form-control" disabled>{{ $detail->agility_add_comments }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-10 mt-3">
                                    <h3>Resistance Training </h3>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">No of Reps for Each Workout</label>
                                        <input type="text" placeholder="10" class="form-control" disabled value="{{ $detail->resistance_workout }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Number of Laps</label>
                                        <input type="text" placeholder="08" class="form-control" disabled value="{{ $detail->resistance_no_of_laps }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Whether Completed within the Stipulated time </label>
                                        <input type="text" placeholder="10:00 AM" class="form-control" disabled value="{{ $detail->resistance_stipulated_time }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Any Difficulty Noticed</label>
                                        <input type="text" placeholder="Difficulty" class="form-control" disabled value="{{ $detail->resistance_difficulty_noticed }}">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Additional Comments</label>
                                        <textarea placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                                            class="form-control" disabled>{{ $detail->resistance_add_comments }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">The Denomination of the Weights used</label>
                                        <input type="text" placeholder="65KGs" class="form-control" disabled value="{{ $detail->denomination }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">What Kind of Props were used for the
                                            Workouts</label>
                                        <input type="text" placeholder="65KGs" class="form-control" disabled  value="{{ $detail->type_of_props }}">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Whether Completed within the Stipulated time </label>
                                        <input type="text" placeholder="Cardio Session" class="form-control" disabled value="{{ $detail->denomination_stipulated_time }}">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Additional Comments</label>
                                        <textarea placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                                            class="form-control" disabled>{{ $detail->denomination_add_comments }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-10 mt-3">
                                    <h3>Cool Down Stretches</h3>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Time Taken</label>
                                        <input type="text" placeholder="3 Hours" class="form-control" disabled value="{{ $detail->stretches_time_taken }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Any Difficulty Noticed</label>
                                        <input type="text" placeholder="Difficulty" class="form-control" disabled value="{{ $detail->stretches_difficulty_noticed }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @else
        <main>
            <div class="content-wrap">
                <div class="row">
                    <div class="col">
                        <h4 style="text-align: center"><span class="alert alert-danger">Please wait, your performance will be added shortly..!!</span></h4>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection

@section('js')
<script type = "text/javascript">
    

  </script>
@endsection