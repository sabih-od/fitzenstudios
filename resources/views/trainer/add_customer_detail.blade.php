@extends('layouts.trainer')
@section('page-title')
Add Customer Detail
@endsection
@section('style')
    <style>
        #step2 {
            display: none;
        }
        #step3 {
            display: none;
        }
        #step4{
            display: none;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="content-wrap">
            <div class="booking-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Add Customer Details</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="prf-detailwrap">
                            <form class="container-fluid p-0" enctype="multipart/form-data" method="POST" action="{{ url('trainer/update_customer_details') }}">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Customer Name</label>
                                        <input type="text" class="form-control" readonly name="customer_name" value="{{ $cust_name->first_name.' '.$cust_name->last_name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Trainer Name</label>
                                        <input type="text" class="form-control" name="trainer_name" readonly value="{{ $cust_name->first_name.' '.$cust_name->last_name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Feedback</label>
                                        <textarea name="feedback" class="form-control" cols="30" rows="10" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btnStyle">ADD DETAILS</button>
                                </div>
                                {{-- <div class="row" id="step1">
                                    <div class="col-12">
                                        <p class="secHeading">Observation Form</p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Owns a fitness tracker</label>
                                            <select name="owns_fitness_tracker" id="owns_fitness_tracker" class="form-control">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Time Zone</label>
                                            <select name="time_zone" id="time_band" class="form-control">
                                                @foreach ($time_zones as $item)
                                                    <option value="{{ $item->zone_name.' '.$item->time_zone }}">{{ $item->zone_name.' '.$item->time_zone }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input type="time" name="detail_time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type of training</label>
                                            <select name="training_type" id="training_type" class="form-control">
                                                <option value="personal">Personal</option>
                                                <option value="professional">Professional</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Trainer Assigned</label>
                                            <input type="text" readonly name="trainer_assigned" value="{{ $get_name->name.' '.$get_name->last_name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No of sessions in a week</label>
                                            <input type="number" name="total_sessions_in_week" class="form-control" placeholder="No of sessions in a week">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="step1_btn" class="btnStyle">Next Step
                                        </button>
                                    </div>
                                </div>
                                <div class="row" id="step2">
                                    <div class="col-12">
                                        <div class="prf-detailwrap">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="secHeading">Fitness Objective</h2>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="d-block">Type</label>
                                                        <div class="form-check  form-check-inline">
                                                            <input class="form-check-input" type="checkbox" value="Weight Loss" name="fitness_type[]" id="defaultCheck1">
                                                            <label class="form-check-label mb-0" for="defaultCheck1">
                                                                Weight Loss
                                                            </label>
                                                        </div>
                                                        <div class="form-check  form-check-inline">
                                                            <input class="form-check-input" type="checkbox" value="Increasing Endurance" name="fitness_type[]" id="defaultCheck2">
                                                            <label class="form-check-label mb-0" for="defaultCheck2">
                                                                Increasing Endurance
                                                            </label>
                                                        </div>
                                                        <div class="form-check  form-check-inline">
                                                            <input class="form-check-input" type="checkbox" value="Building Muscle" name="fitness_type[]" id="defaultCheck3">
                                                            <label class="form-check-label mb-0" for="defaultCheck3">
                                                                Building Muscle
                                                            </label>
                                                        </div>
                                                        <div class="form-check  form-check-inline">
                                                            <input class="form-check-input" type="checkbox" value="Improving Strength" name="fitness_type[]" id="defaultCheck4">
                                                            <label class="form-check-label mb-0" for="defaultCheck4">
                                                                Improving Strength
                                                            </label>
                                                        </div>
                                                        <div class="form-check  form-check-inline">
                                                            <input class="form-check-input" type="checkbox" value="Increasing Muscle Endurance" name="fitness_type[]" id="defaultCheck5">
                                                            <label class="form-check-label mb-0" for="defaultCheck5">
                                                                Increasing Muscle Endurance
                                                            </label>
                                                        </div>
                                                        <div class="form-check  form-check-inline">
                                                            <input class="form-check-input" type="checkbox" value="EDL Improvement" name="fitness_type[]" id="defaultCheck6">
                                                            <label class="form-check-label mb-0" for="defaultCheck6">
                                                                EDL Improvement
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Period</label>
                                                        <select name="period" id="period" class="form-control">
                                                            <option value="3 months">3 Months</option>
                                                            <option value="6 months">6 Months</option>
                                                            <option value="9 months">9 Months</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Prior Workout Experience</label>
                                                        <textarea name="workout_experience" id="workout_experience" rows="5" class="form-control" placeholder="Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Lifestyle</label>
                                                        <textarea name="life_style" id="life_style" rows="5" class="form-control"
                                                                    placeholder="Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="button" id="step2_btn" class="btnStyle">Next Step
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="step3">
                                    <div class="col-12">
                                        <div class="prf-detailwrap">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h2 class="secHeading">Focus of Workouts</h2>
                                                        <select name="focus_of_workout" id="focus" class="form-control">
                                                            <option value="Increased focus on Mobility">Increased focus on Mobility</option>
                                                            <option value="option 2">option 2</option>
                                                            <option value="option 3">option 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h2 class="secHeading">Type</h2>
                                                        <select name="workout_type" id="type" class="form-control">
                                                            <option value="Beginner Workout">Beginner Workout</option>
                                                            <option value="option 2">option 2</option>
                                                            <option value="option 3">option 3</option>
                                                        </select>
                                                    </div>
                                                </div>
            
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h2 class="secHeading">Injuries</h2>
            
                                                        <div class="form-check  form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="injuries[]" value="Lower back and knee"
                                                                    id="defaultCheck1">
                                                            <label class="form-check-label mb-0" for="defaultCheck1">
                                                                Lower back and knee
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check  form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="injuries[]"  value="Stiffness in the right side of the neck and the shoulder"
                                                                    id="defaultCheck2">
                                                            <label class="form-check-label mb-0" for="defaultCheck2">
                                                                Stiffness in the right side of the neck and the shoulder
                                                            </label>
                                                        </div>
            
                                                    </div>
            
                                                </div>
            
                                                <div class="col-md-12">
                                                    <button type="button" id="step3_btn" class="btnStyle">Next Step </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="step4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h2 class="secHeading">Medical Condition 	</h2>

                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input" type="checkbox"  name="med_conditions[]"  value="Thyroid" 
                                                       id="defaultCheck1">
                                                <label class="form-check-label mb-0" for="defaultCheck1">
                                                    Thyroid
                                                </label>
                                            </div>

                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input" type="checkbox"  name="med_conditions[]" value="Pre Osteoporosis" id="defaultCheck2">
                                                <label class="form-check-label mb-0" for="defaultCheck2">
                                                    Pre Osteoporosis
                                                </label>
                                            </div>

                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="med_conditions[]"  value="Menopause"
                                                       id="defaultCheck2">
                                                <label class="form-check-label mb-0" for="defaultCheck2">
                                                    Menopause
                                                </label>
                                            </div>

                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="med_conditions[]"  value="Cholesterol"
                                                       id="defaultCheck2">
                                                <label class="form-check-label mb-0" for="defaultCheck2">
                                                    Cholesterol
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h2 class="secHeading">On Medication</h2>
                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="on_medication[]" value="Thyroid"
                                                       id="defaultCheck1">
                                                <label class="form-check-label mb-0" for="defaultCheck1">
                                                    Thyroid
                                                </label>
                                            </div>

                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="on_medication[]" value="Cholesterol"
                                                       id="defaultCheck2">
                                                <label class="form-check-label mb-0" for="defaultCheck2">
                                                    Cholesterol
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Medical Condition</label>
                                            <input name="medical_condition" type="text" placeholder="Average - 6 hours in a day" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btnStyle">Submit Now</button>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).on('click', '#step1_btn', function() {
            $('#step1').hide();
            $('#step2').show();
        });

        $(document).on('click', '#step2_btn', function() {

            $('#step1').hide();
            $('#step2').hide();
            $('#step3').show();

        });

        $(document).on('click', '#step3_btn', function() {

            $('#step1').hide();
            $('#step2').hide();
            $('#step3').hide();
            $('#step4').show();

        });
    </script>
@endsection