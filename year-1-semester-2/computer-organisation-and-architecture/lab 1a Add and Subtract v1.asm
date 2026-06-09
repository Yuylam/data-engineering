TITLE Addand Subtract(AddSub.asm)

; This program addsand subtracts 32 - bit integers
; Authors: Lam Yoke Yu & Tan Yi Ya
; Date: 
; Revision:

INCLUDE Irvine32.inc

.data
TOTAL dword 0; a variable named TOTAL(declared as DWORD)

.code

main PROC

mov eax, 123400h; Set EAX with the value of 123400h
add eax, 567800h; Add the content of EAX with 567800h
sub eax, 77700h; Subtract content of EAX with 77700h
mov TOTAL, eax; Store content of EAX to TOTAL

call DumpRegs

exit
main ENDP

END main
