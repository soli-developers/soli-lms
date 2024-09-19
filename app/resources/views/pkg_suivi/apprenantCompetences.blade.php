@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Suivi d'avancement des compétences</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header col-md-12">
                    <div class="col-md-3">
                        <select class="form-control-sm form-control" id="apprenantSelect" name="apprenant">
                            <option value="">Apprenant</option>
                            @foreach ($results as $result)
                                <option value="{{ $result['name'] }}" {{ request('apprenant') == $result['name'] ? 'selected' : '' }}>
                                    {{ $result['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Apprenant</th>
                                    @foreach($competences as $competence)
                                        <th title="{{ $competence->nom }}">{{ $competence->code }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                    <tr>
                                        <td>{{ $result['name'] }}</td>
                                        @foreach($competences as $competence)
                                            <td>
                                                @php
                                                    $badgeClass = '';
                                                    switch($result[$competence->nom]) {
                                                        case 'Insuffisant':
                                                            $badgeClass = 'bg-danger';
                                                            break;
                                                        case 'Passable':
                                                            $badgeClass = 'bg-info';
                                                            break;
                                                        case 'Très bien':
                                                            $badgeClass = 'bg-success';
                                                            break;
                                                        case 'Aucune':
                                                            $badgeClass = 'bg-secondary';
                                                            break;
                                                        default:
                                                            $badgeClass = '';
                                                            break;
                                                    }
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">{{ $result[$competence->nom] }}</span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end align-items-right p-2">
                        <div class="mr-5">
                            <ul class="pagination m-0 float-right">
                                {{ $results->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
