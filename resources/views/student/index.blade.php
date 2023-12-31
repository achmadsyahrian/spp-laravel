@extends('layouts.main')
@section('content')

@if (session()->has('success'))
   <x-sweetalert type="success" head="Success!" body="{{ session('success') }}" ></x-sweetalert>
@endif

<div class="row">
   <div class="col-lg-12 col-md-12">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-8">
                        <h5 class="text-c-blue">Fandi Arifansyah</h5>
                        <h6 class="text-muted m-b-0">Jabatan : <span class="text-c-blue">Ketua Komisaris</span></h6>
                     </div>
                     <div class="col-4 text-right">
                        <i class="fas fa-user-tie f-28 text-c-blue"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-sm-12">
            <a href="/student/create">
               <button type="button" class="btn btn-primary btn-block">
                  Add Student <i class="fas fa-plus-circle mr-2"></i>
               </button>
            </a>
         </div>
     </div>
      <div class="row mt-3">
         <div class="col-xl-12 col-md-12">
            <div class="card table-card">
               <div class="card-header">
                  <h5>Mahasiswa</h5>
                  <div class="card-header-right">
                     <div class="btn-group card-option">
                           <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="feather icon-more-horizontal"></i>
                           </button>
                           <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                              <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                              <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                              <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                           </ul>
                     </div>
                  </div>
               </div>
               <div class="card-body p-0">
                  <div class="table-responsive">
                     <table class="table table-hover mb-0">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Profile</th>
                              <th>Gender</th>
                              <th>Phone</th>
                              <th class="text-right">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $student)    
                           <tr>
                              <td>{{ $loop->iteration + ($students->perPage() * ($students->currentPage() - 1)) }}</td>
                              <td>
                                 <div class="d-inline-block align-middle">
                                       @if (!$student->photo)
                                          <x-images.image-round-profile photo="images/user/default-user-2.png"></x-images.image-round-profile>
                                       @else
                                          <x-images.image-round-profile   ges.image-round-profile photo="storage/{{ $student->photo }}"></x-images.image-round-profile>
                                       @endif
                                       <div class="d-inline-block">
                                          <h6>{{ $student->user->name }}</h6>
                                          <p class="text-muted m-b-0">{{ $student->nim }}</p>
                                       </div>
                                 </div>
                              </td>
                              <td>{{ Str::ucfirst($student->gender) }}</td>
                              <td>{{ $student->phone ? $student->phone : 'Belum Diisi' }}</td>
                              <td class="text-right">
                                 <x-buttons.button-edit-icon id="/student/{{ $student->id }}/edit"></x-buttons.button-edit-icon>
                              </td>
                           </tr>
                        @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-12">
            <nav aria-label="...">
               <ul class="pagination justify-content-center">
                   @if ($students->hasPages())
                       <li class="page-item">
                           <span class="page-link">{{ $students->links() }}</span>
                       </li>
                   @endif
               </ul>
           </nav>           
         </div>
      </div>
   </div>
</div>
@endsection