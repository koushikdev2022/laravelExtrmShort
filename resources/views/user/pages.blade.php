@extends('layouts.master')

@section('content')

@if($page_for==='setting')
<livewire:user.setting />
@elseif($page_for==='user.verification')
<livewire:user.verification />
@elseif($page_for==='user.notification')
<livewire:user.notification />
@elseif($page_for==='projects')
<livewire:project.projects :projecttype="$project_type" />

@elseif($page_for==='user.accept-proposal-projects')
<livewire:project.accept-proposal-projects />

@elseif($page_for==='view_proposal_award')
<livewire:user.view-proposal-award :bidid="$bid_id" />

@elseif($page_for==='view_proposal_list')
<livewire:user.view-proposal-list :projectid="$project_id" />

@elseif($page_for==='projects.create')
<livewire:project.step-form isNew="true" existProject="" />
@elseif($page_for==='projects.edit')
<livewire:project.step-form isNew="false" :existProject="$project" />
@elseif($page_for==='user.award-projects')
<livewire:project.award-projects />
@elseif($page_for==='award-project.detail')
<livewire:milestones.project-detail :project="$project" />
@elseif($page_for==='user.wallet')
<livewire:user-payment.wallet />
@elseif($page_for==='user.deposit')
<livewire:user-payment.deposit-money />
@elseif($page_for==='user.withdrawal')
<livewire:user-payment.withdrawal />
@endif

@stop
