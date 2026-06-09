INCLUDE Irvine32.inc

.data
    max_loop DWORD ?          ; Number of iterations
    sum DWORD 0
    coef1 DWORD 7             ; Set from birthday (day)
    coef2 DWORD 9             ; Set from birthday (day)
    coef3 DWORD 13            ; Set from birthday (day)
    coef4 DWORD 25            ; Set from birthday (day)
    capture_msec_before DWORD ?
    capture_msec_after DWORD ?
    elapsed_time DWORD ?
    x DWORD ?
    y DWORD ?
    prompt BYTE "Welcome to CPU Benchmark Program", 0
    prompt1 BYTE "Benchmark CPU time Using Equation y = 7*x^3 + 9*x^2 + 13*x + 25", 0
    prompt2 BYTE "(with delay coef1, coef2, coef3, coef4 = 7, 9, 13, 25 msec)", 0
    prompt3 BYTE "Enter Number of Looping (N) = ", 0
    prompt4 BYTE "CPU time Stress Test in progress...", 0
    prompt5 BYTE "Result:", 0
    prompt6 BYTE "First Capture Execution time in millisecond: ", 0
    prompt7 BYTE "Second Capture Execution time in millisecond: ", 0
    prompt8 BYTE "Different Execution time in millisecond: ", 0
    prompt9 BYTE "Value of Sum from the Stress Test (polynomial) = ", 0
    prompt10 BYTE "Press 'y' to continue or 'n' to exit the benchmark: ", 0
    new_line BYTE 13, 10, 0   ; Newline characters for formatting

.code
main PROC
    ; Display welcome message
    mov edx, OFFSET prompt
    call WriteString
    call Crlf

    mov edx, OFFSET prompt1
    call WriteString
    call Crlf

    mov edx, OFFSET prompt2
    call WriteString
    call Crlf

    ; Main loop to continue until 'n' is pressed
    continue_loop:
        ; Get user input for max_loop
        mov edx, OFFSET prompt3
        call WriteString
        call ReadInt
        mov max_loop, eax
        call Crlf

        ; Display test in progress message
        mov edx, OFFSET prompt4
        call WriteString
        call Crlf

        ; Initialize sum to 0
        mov sum, 0

        ; Capture start time
        call GetMseconds
        mov capture_msec_before, eax

        ; Perform polynomial calculation in loop
        mov ecx, max_loop
        mov edi, 1                ; Initialize loop counter

    loop_start:
        mov eax, edi              ; eax = x
        imul eax, edi             ; eax = x^2
        mov ebx, eax              ; ebx = x^2
        imul eax, edi             ; eax = x^3
        imul eax, coef1           ; eax = coef1 * x^3
        mov y, eax                ; y = coef1 * x^3

        mov eax, ebx              ; eax = x^2
        imul eax, coef2           ; eax = coef2 * x^2
        add y, eax                ; y = y + coef2 * x^2

        mov eax, edi              ; eax = x
        imul eax, coef3           ; eax = coef3 * x
        add y, eax                ; y = y + coef3 * x

        mov eax, coef4            ; load coef4 into eax
        add y, eax                ; y = y + coef4

        ; Add y to sum
        mov eax, sum              ; load sum into eax
        add eax, y                ; add y to eax
        mov sum, eax              ; store result back into sum

        ; Delay with coef1, coef2, coef3, and coef4
        mov eax, coef1
        call Delay
        mov eax, coef2
        call Delay
        mov eax, coef3
        call Delay
        mov eax, coef4
        call Delay

        ; Increment loop counter
        inc edi

        loop loop_start

        ; Capture end time
        call GetMseconds
        mov capture_msec_after, eax

        ; Calculate elapsed time
        mov eax, capture_msec_after
        sub eax, capture_msec_before
        mov elapsed_time, eax

        ; Display results
        mov edx, OFFSET prompt5
        call WriteString
        call Crlf

        mov edx, OFFSET prompt6
        call WriteString
        mov eax, capture_msec_before
        call WriteDec
        call Crlf

        mov edx, OFFSET prompt7
        call WriteString
        mov eax, capture_msec_after
        call WriteDec
        call Crlf

        ; Calculate difference in execution time
        mov eax, capture_msec_after
        sub eax, capture_msec_before
        mov edx, OFFSET prompt8
        call WriteString
        call WriteDec
        call Crlf

        mov edx, OFFSET prompt9
        call WriteString
        mov eax, sum
        call WriteDec
        call Crlf

        ; Prompt for continuation
        mov edx, OFFSET prompt10
        call WriteString
        call ReadChar

        cmp al, 'y'  ; Check if 'y' was pressed
        je restart_loop  ; Jump to restart loop if 'y' was pressed

        cmp al, 'n'  ; Check if 'n' was pressed
        jne continue_loop  ; Jump to continue loop if 'n' was not pressed

    ; Exit program
    exit

    restart_loop:
        ; Output a newline to separate runs
        mov edx, OFFSET new_line
        call WriteString

        ; Redisplay prompts for the next run
        jmp continue_loop

main ENDP

END main
