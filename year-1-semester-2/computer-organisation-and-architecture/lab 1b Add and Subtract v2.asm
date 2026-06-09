TITLE Addand Subtract, Version 2(AddSub2.asm)

; This program addsand subtracts 32 - bit unsigned
; integersand stores the sum in a variable.
; Authors: Lam Yoke Yu & Tan Yi Ya
; Date:
; Revision:

INCLUDE Irvine32.inc
.data
val1 DWORD 10000h
val2 DWORD 40000h
val3 DWORD 20000h
finalVal DWORD ?
.code

main PROC
mov eax, val1; start with 10000h
add eax, val2; add 40000h
sub eax, val3; subtract 20000h
mov finalVal, eax; store the result(30000h)

call DumpRegs; display the registers

exit

main ENDP
END main
