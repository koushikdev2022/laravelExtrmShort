
   
         <div class="common-section-box-content">
             <form action="" method="POST" wire:submit.prevent="resetPassword">
                 <div class="step_bx">
                     <div class="row">
                         {{-- <div class="col-lg-12">
                             <div class="form-group">
                                 <label>Old Password</label>
                                 <input class="form-control" wire:model.defer="passwordForm.password"
                                     placeholder="Enter Password" type="password" required>
                                 @error('passwordForm.password')
                                 <p class="text-sm mt-2 text-red-500">
                                     {{ $message }}
                                 </p>
                                 @enderror
                             </div>
                         </div> --}}
                         <div class="col-lg-12">
                             <div class="form-group">
                                 <label>New Password</label>
                                 <input class="form-control" wire:model.defer="passwordForm.new_password"
                                     placeholder="Enter New Password" type="password" required>
                                 @error('passwordForm.new_password')
                                 <p class="text-sm mt-2 text-red-500">
                                     {{ $message }}
                                 </p>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-lg-12">
                             <div class="form-group">
                                 <label>Confirm Password</label>
                                 <input class="form-control" wire:model.defer="passwordForm.confirm_password"
                                     placeholder="Enter Confirm Password" type="password" required>
                                 @error('passwordForm.confirm_password')
                                 <p class="text-sm mt-2 text-red-500">
                                     {{ $message }}
                                 </p>
                                 @enderror
                             </div>
                         </div>
                     </div>
                     <div class="text-center save mb-3 dash_btnwrp">
                         <button type="submit" class="common-btn green" wire:loading.class="d-none">Save</button>
                         <button class="common-btn green custloading" type="button" wire:loading
                             wire:target="resetPassword" disabled>
                             <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                         </button>
                     </div>
                 </div>


             </form>
         </div>
    
