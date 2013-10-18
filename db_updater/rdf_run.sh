#!/bin/bash

cd /home/ljuser/tools

mv data data_log
mkdir data

perl rdf_dir.pl >> parser_log.txt

rm -rf data_log
