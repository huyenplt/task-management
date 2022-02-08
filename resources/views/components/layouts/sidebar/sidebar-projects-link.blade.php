<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-folder"></i>
        <span>Project</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Project:</h6>
            <a class="collapse-item" href="{{route('project.create')}}">
                <i class="fas fa-plus"></i>
                <span>Add New Project</span>
            </a>
            <a class="collapse-item" href="{{route('project.index')}}">View All Projects</a>
        </div>
    </div>
</li>