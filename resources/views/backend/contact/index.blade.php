@extends('layouts.dashboard')

@section('title')
  Contact
@endsection

@section('contact')
  active
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Contact</span>
  </nav>
@endsection

@section('content')
<div class="col-lg-8 col-md-12 col-sm-12 m-auto" >
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Contact Page queries</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-primary mg-b-0">
              <tr>
                <th>Sl.</th>
                <th>Sender</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
              </tr>
              @forelse ($contacts as $index => $contact)
                 @if($contact->status == 0)
                  
                    <tr style="font-weight:bold; background:rgba(12, 67, 78, 0.5); color:white;" onclick="window.location=">
                      <td style="color:#fff;font-weight:bold;"><a href="{{ route('contacts.show', $contact->id) }}">{{ $contacts -> firstItem() + $index }}</a></td>
                      <td style="color:#fff;font-weight:bold;"><a href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>
                      <td style="color:#fff;font-weight:bold;"><a href="{{ route('contacts.show', $contact->id) }}">{{ $contact->email }}</a></td>
                      <td style="color:#fff;font-weight:bold;"><a href="{{ route('contacts.show', $contact->id) }}">{{ Str::limit($contact->subject, 5) }}</a></td>
                      <td style="color:#fff;font-weight:bold;"><a href="{{ route('contacts.show', $contact->id) }}">{{ Str::limit($contact->message, 15) }}</a></td>
                      <td style="color:#fff;font-weight:bold;">{{ $contact->created_at->format('d-M-Y') }}</td>
                    </tr>

                @else
                    <tr>
                      <td><a style="color:#000;" href="{{ route('contacts.show', $contact->id) }}">{{ $contacts -> firstItem() + $index }}</a></td>
                      <td><a style="color:#000;" href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>
                      <td><a style="color:#000;" href="{{ route('contacts.show', $contact->id) }}">{{ $contact->email }}</a></td>
                      <td><a style="color:#000;" href="{{ route('contacts.show', $contact->id) }}">{{ Str::limit($contact->subject, 5) }}</a></td>
                      <td><a style="color:#000;" href="{{ route('contacts.show', $contact->id) }}">{{ Str::limit($contact->message, 15) }}</a></td>
                      <td style="color: #000;">{{ $contact->created_at->format('d-M-Y') }}</td>
                    </tr>
                 @endif
              @empty 
                <tr>
                  <td>No messages</td>
                </tr>
              @endforelse
            </table>
            {{ $contacts->links() }}
          </div>
        </div>
    </div>
</div>
@endsection