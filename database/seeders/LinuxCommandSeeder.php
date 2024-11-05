<?php

namespace Database\Seeders;

use App\Models\LinuxCommand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinuxCommandSeeder extends Seeder
{
    public function run()
    {
        LinuxCommand::truncate();
        $commands =
            [
                [
                    'command' => 'ls',
                    'description' => 'List directory contents',
                    'category' => 'file_management',
                    'examples' => [
                        'ls -l',
                        'ls -la',
                        'ls Documents/',
                        'ls -lh'
                    ],
                    'flags' => [
                        '-l' => 'Long listing format',
                        '-a' => 'Show hidden files',
                        '-h' => 'Human-readable sizes',
                        '-R' => 'Recursive listing',
                        '-t' => 'Sort by modification time',
                        '-S' => 'Sort by file size'
                    ]
                ],
                [
                    'command' => 'cd',
                    'description' => 'Change directory',
                    'category' => 'navigation',
                    'examples' => [
                        'cd Documents',
                        'cd ..',
                        'cd ~',
                        'cd -'
                    ],
                    'flags' => []
                ],
                [
                    'command' => 'mkdir',
                    'description' => 'Make directory',
                    'category' => 'file_management',
                    'examples' => [
                        'mkdir new_folder',
                        'mkdir -p path/to/new/folder',
                        'mkdir -m 755 secured_folder'
                    ],
                    'flags' => [
                        '-p' => 'Create parent directories as needed',
                        '-m' => 'Set file mode/permissions',
                        '-v' => 'Print a message for each created directory'
                    ]
                ],
                [
                    'command' => 'grep',
                    'description' => 'Search text using patterns',
                    'category' => 'text_processing',
                    'examples' => [
                        'grep "pattern" file.txt',
                        'grep -i "case-insensitive" file.txt',
                        'grep -r "pattern" directory/'
                    ],
                    'flags' => [
                        '-i' => 'Case insensitive search',
                        '-r' => 'Recursive search',
                        '-n' => 'Show line numbers',
                        '-v' => 'Invert match',
                        '-c' => 'Count matching lines',
                        '-w' => 'Match whole words only'
                    ]
                ],
                [
                    'command' => 'cp',
                    'description' => 'Copy files and directories',
                    'category' => 'file_management',
                    'examples' => [
                        'cp file.txt backup.txt',
                        'cp -r folder/ backup/',
                        'cp -i source.txt dest.txt'
                    ],
                    'flags' => [
                        '-r' => 'Copy directories recursively',
                        '-i' => 'Interactive (prompt before overwrite)',
                        '-v' => 'Verbose output',
                        '-p' => 'Preserve file attributes'
                    ]
                ],
                [
                    'command' => 'mv',
                    'description' => 'Move/rename files and directories',
                    'category' => 'file_management',
                    'examples' => [
                        'mv old.txt new.txt',
                        'mv file.txt ~/Documents/',
                        'mv -i source.txt dest.txt'
                    ],
                    'flags' => [
                        '-i' => 'Interactive (prompt before overwrite)',
                        '-v' => 'Verbose output',
                        '-f' => 'Force move without confirmation',
                        '-n' => 'No overwrite'
                    ]
                ],
                [
                    'command' => 'rm',
                    'description' => 'Remove files and directories',
                    'category' => 'file_management',
                    'examples' => [
                        'rm file.txt',
                        'rm -r directory/',
                        'rm -f unwanted.txt'
                    ],
                    'flags' => [
                        '-r' => 'Remove directories recursively',
                        '-f' => 'Force removal without confirmation',
                        '-i' => 'Interactive (prompt before removal)',
                        '-v' => 'Verbose output'
                    ]
                ],
                [
                    'command' => 'chmod',
                    'description' => 'Change file permissions',
                    'category' => 'file_management',
                    'examples' => [
                        'chmod 755 script.sh',
                        'chmod +x script.sh',
                        'chmod -R 644 directory/'
                    ],
                    'flags' => [
                        '-R' => 'Change files and directories recursively',
                        '-v' => 'Verbose output',
                        '-f' => 'Suppress error messages',
                        '-c' => 'Report changes made'
                    ]
                ],
                [
                    'command' => 'find',
                    'description' => 'Search for files in directory hierarchy',
                    'category' => 'file_management',
                    'examples' => [
                        'find . -name "*.txt"',
                        'find /home -type d',
                        'find . -mtime -7'
                    ],
                    'flags' => [
                        '-name' => 'Search by file name',
                        '-type' => 'Search by file type',
                        '-mtime' => 'Search by modification time',
                        '-size' => 'Search by file size',
                        '-exec' => 'Execute command on found files'
                    ]
                ],
                [
                    'command' => 'tar',
                    'description' => 'Archive files',
                    'category' => 'file_management',
                    'examples' => [
                        'tar -czf archive.tar.gz files/',
                        'tar -xzf archive.tar.gz',
                        'tar -tvf archive.tar'
                    ],
                    'flags' => [
                        '-c' => 'Create archive',
                        '-x' => 'Extract archive',
                        '-f' => 'Specify archive file',
                        '-v' => 'Verbose output',
                        '-z' => 'Filter through gzip',
                        '-t' => 'List archive contents'
                    ]
                ],
                [
                    'command' => 'ps',
                    'description' => 'Report process status',
                    'category' => 'process_management',
                    'examples' => [
                        'ps aux',
                        'ps -ef',
                        'ps -u username'
                    ],
                    'flags' => [
                        '-a' => 'Show processes of all users',
                        '-u' => 'Show process user/owner',
                        '-x' => 'Show processes without controlling terminal',
                        '-e' => 'Show all processes',
                        '-f' => 'Full format listing'
                    ]
                ],
                [
                    'command' => 'top',
                    'description' => 'Display system processes',
                    'category' => 'process_management',
                    'examples' => [
                        'top',
                        'top -u username',
                        'top -n 10'
                    ],
                    'flags' => [
                        '-n' => 'Number of iterations',
                        '-u' => 'Show specific user processes',
                        '-b' => 'Batch mode',
                        '-d' => 'Specify delay interval'
                    ]
                ],
                [
                    'command' => 'df',
                    'description' => 'Report file system disk space usage',
                    'category' => 'system_info',
                    'examples' => [
                        'df -h',
                        'df -i',
                        'df /home'
                    ],
                    'flags' => [
                        '-h' => 'Human-readable sizes',
                        '-i' => 'List inode information',
                        '-T' => 'Show file system type',
                        '-a' => 'Show all file systems'
                    ]
                ],
                [
                    'command' => 'du',
                    'description' => 'Estimate file space usage',
                    'category' => 'system_info',
                    'examples' => [
                        'du -h',
                        'du -sh *',
                        'du -a'
                    ],
                    'flags' => [
                        '-h' => 'Human-readable sizes',
                        '-s' => 'Display only total',
                        '-a' => 'Show sizes of all files',
                        '-c' => 'Show grand total'
                    ]
                ],
                [
                    'command' => 'ping',
                    'description' => 'Send ICMP ECHO_REQUEST to network hosts',
                    'category' => 'networking',
                    'examples' => [
                        "ping google.com",
                        "ping -c 4 192.168.1.1",
                        "ping -i 2 server.com"
                    ],
                    'flags' => [
                        '-c' => 'Number of packets to send',
                        '-i' => 'Interval between packets in seconds',
                        '-w' => 'Deadline timeout in seconds',
                        '-s' => 'Specify packet size'
                    ]
                ],
                    [
                        'command' => 'netstat',
                        'description' => 'Network statistics',
                        'category' => 'networking',
                        'examples' => [
                            'netstat -tuln',
                            'netstat -anp',
                            'netstat -r'
                        ],
                        'flags' => [
                            '-t' => 'Show TCP connections',
                            '-u' => 'Show UDP connections',
                            '-l' => 'Show only listening sockets',
                            '-n' => 'Show numerical addresses',
                            '-p' => 'Show process ID/name'
                        ]
                    ],
                    [
                        'command' => 'curl',
                        'description' => 'Transfer data from or to a server',
                        'category' => 'networking',
                        'examples' => [
                            'curl https://api.example.com',
                            'curl -o file.txt https://example.com/file',
                            'curl -X POST -d "data" https://api.example.com'
                        ],
                        'flags' => [
                            '-o' => 'Write output to file',
                            '-X' => 'Specify request method',
                            '-H' => 'Add header to request',
                            '-d' => 'Send POST data',
                            '-i' => 'Include protocol response headers'
                        ]
                    ],
                    [
                        'command' => 'useradd',
                        'description' => 'Create a new user',
                        'category' => 'user_management',
                        'examples' => [
                            'useradd john',
                            'useradd -m -s /bin/bash john',
                            'useradd -u 1500 john'
                        ],
                        'flags' => [
                            '-m' => 'Create home directory',
                            '-s' => 'Specify login shell',
                            '-u' => 'Specify user ID',
                            '-g' => 'Specify primary group',
                            '-G' => 'Specify supplementary groups'
                        ]
                    ],
                    [
                        'command' => 'passwd',
                        'description' => 'Change user password',
                        'category' => 'user_management',
                        'examples' => [
                            'passwd',
                            'passwd username',
                            'passwd -l username'
                        ],
                        'flags' => [
                            '-l' => 'Lock user account',
                            '-u' => 'Unlock user account',
                            '-d' => 'Delete password',
                            '-e' => 'Expire password',
                            '-S' => 'Show password status'
                        ]
                    ],

                    [
                        'command' => 'htop',
                        'description' => 'Interactive process viewer',
                        'category' => 'system_monitoring',
                        'examples' => [
                            'htop',
                            'htop -u username',
                            'htop -p 1234,5678'
                        ],
                        'flags' => [
                            '-u' => 'Show only processes of specified user',
                            '-p' => 'Show only specified processes',
                            '-d' => 'Delay between updates',
                            '-C' => 'Start with specified sort column'
                        ]
                    ],
                    [
                        'command' => 'lsof',
                        'description' => 'List open files',
                        'category' => 'system_monitoring',
                        'examples' => [
                            'lsof',
                            'lsof -i TCP:80',
                            'lsof -u username'
                        ],
                        'flags' => [
                            '-i' => 'List files with network connections',
                            '-u' => 'List files for specific user',
                            '-p' => 'List files for specific process',
                            '-t' => 'Show only process IDs'
                        ]
                    ],

                    [
                        'command' => 'apt',
                        'description' => 'Package management tool',
                        'category' => 'package_management',
                        'examples' => [
                            'apt update',
                            'apt install package_name',
                            'apt remove package_name'
                        ],
                        'flags' => [
                            'update' => 'Update package list',
                            'upgrade' => 'Upgrade installed packages',
                            'install' => 'Install packages',
                            'remove' => 'Remove packages',
                            'autoremove' => 'Remove unused dependencies'
                        ]
                    ]
        ];


        foreach ($commands as $command) {
            LinuxCommand::create($command);
        }
    }
//    public function addCommand(array $commandData)
//    {
//        $required = ['command', 'description', 'category', 'examples', 'flags'];
//
//        // Validate required fields
//        foreach ($required as $field) {
//            if (!isset($commandData[$field])) {
//                throw new \InvalidArgumentException("Missing required field: {$field}");
//            }
//        }
//
//        // Validate examples and flags are arrays
//        if (!is_array($commandData['examples']) || !is_array($commandData['flags'])) {
//            throw new \InvalidArgumentException("Examples and flags must be arrays");
//        }
//
//        return LinuxCommand::create($commandData);
//    }
}

