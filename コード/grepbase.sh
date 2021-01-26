#!/bin/bash
while read line
do
        csvpart=(${line//,/ })
        grep -r -E ".* invoke-.*, L${csvpart[1]};->${csvpart[2]}" ${1} >> "${1}_${2}_result";
done < ${2}
