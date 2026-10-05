<?php

interface RepositorioEstados{
    public function estadoComUf( string $uf): Estado|null;
}