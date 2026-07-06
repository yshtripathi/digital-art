    
            <form name="frmLogin" id="frmLogin" 
            action="{{route('login.submit')}}" method="post" class="row mt-4 align-items-center">
                                @csrf                
                <div class="mb-3 col-sm-12">
                  <!--<input type="email" id="email" class="form-control" placeholder="Email Address">-->
                <!--<label>{{ __('common.email') }}</label>-->
                                <input name="email" type="email"  id="email" placeholder="{{ __('common.email') }}" value="{{old('email')}}" class="form-control" required>
                                            @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror    
                </div>
                <div class="mb-3 col-sm-12">
                  
                    <input type="password" name="password" id="password" placeholder="{{ __('common.password') }}" value="{{old('password')}}" class="form-control" required>
                                            @error('password')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                </div>
                <div class="col-sm-6 text-sm-start">
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input me-2" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Keep me logged in</label>
                  </div>
                </div>
                <div class="col-sm-6 mb-0 mb-sm-3 text-end"><a href="#">Forget Password?</a></div>
                <div class="col-sm-12 mt-2">
                  <div class="sign-btn d-grid mb-3">
                    <!-- <button type="submit" name="submit" class="btn btn-flat btn-primary">Log in</button> -->
                    <input type="submit" name="submit" class="btn btn-flat btn-primary">
                  </div>
                <!--<a class="btn google-bg mb-3 d-grid" href="#"><span><img class="me-2" src="images/Google-logo.svg" alt="Google-logo"> Sign up with Google</span></a>-->
                </div>
                <div class="col-sm-12">
                  <ul class="list-unstyled mt-3">
                    <li class="me-1">{{ __('common.not_a_member_text') }}
                       <a href="{{route('register.form')}}" class="text-primary">{{ __('common.sign_up_now_text') }}</a>
                      </li>
                  </ul>
                </div>
              </form>
              